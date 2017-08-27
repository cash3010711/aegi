<?php namespace Controllers\Domain\Dashboard;
use \Task as Task;
use \Project as Project;
use Cartalyst\Sentry\Facades\Laravel\Sentry as Sentry;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

/**
 * Calendar Controller.    
 * @version    1.0.0
 * @author     Chintan Banugaria
 * @copyright  (c) 2014, 92fiveapp
 * @link       http://92fiveapp.com
 **/

class CalendarController extends \BaseController{

	protected $event;

	/**
	* Constructor
	*/
	public function __construct()
	{
		$this->event = \App::make('CalendarInterface');
	}
	/**
	* Get the event dates and events for the currently logged in user
	* @return View
	*/

	public function getIndex()
	{

			//Get the user id of the currently logged in user
			$userId =  \Sentry::getUser()->id;
			//Current Date
			$day = date("Y-m-d");
			//Get events for current date
			$events = $this->event->getEvents($userId,$day);
			
			//$projects = $this->project->getProjects($userId,$day);

			$project_user_count = \Projectcollabs::where('user_id','=',$userId)->count(); //當前使用者的計畫數量
			$projectuser_first_id = \Projectcollabs::where('id','>',0)->pluck('id'); //第一筆pro_user的id
			$project_user_all_count = \Projectcollabs::where('id','>',0)->count(); //project user的總資料筆數
			$project_user; //存放project user相關值
			for($loop=0,$loop2=0;$loop<$project_user_all_count;$loop++){
				$projectuser_userid = \Projectcollabs::where('id','=',$projectuser_first_id+$loop)->pluck('user_id'); //取得全部的user_id
				if($projectuser_userid == $userId){
					$project_user_project_id = \Projectcollabs::where('id','=',$projectuser_first_id+$loop)->pluck('project_id');
					$project_user[$loop2]['date'] = Project::where('id','=',$project_user_project_id)->pluck('start_date');
					$loop2++;
				}
			}

			/*$projects_first_date = Project::where('id','>',0)->pluck('id');
			$projects_count = Project::where('id','>',0)->count();

			$projects_date;
			for($loop=0;$loop<$projects_count;$loop++){
				$projects_date[$loop]['date'] = Project::where('id','=',$projects_first_date+$loop)->pluck('start_date');
			}*/

			/*$tasks_first_date = Task::where('id','>',0)->pluck('id');
			$tasks_count = Task::where('id','>',0)->count();
			$tasks_date;
			for($loop=0;$loop<$tasks_count;$loop++){
				$tasks_date[$loop]['date'] = Task::where('id','=',$tasks_first_date+$loop)->pluck('start_date');
			}*/
			
			//Get all  event dates for the user
			$eventDates = $this->event->getEventDates($userId);

			$newjson = json_encode(
				array_merge(
				  	$project_user,
					json_decode($eventDates)//,
					//$tasks_date
				)
			);

			for($loop=0,$loop2=0;$loop<$project_user_all_count;$loop++){
				$projectuser_userid = \Projectcollabs::where('id','=',$projectuser_first_id+$loop)->pluck('user_id'); //取得全部的user_id
				if($projectuser_userid == $userId){
					$project_user_project_id = \Projectcollabs::where('id','=',$projectuser_first_id+$loop)->pluck('project_id');
					$project_user[$loop2]['id'] = Project::where('id','=',$project_user_project_id)->pluck('id');
					$project_user[$loop2]['project_name'] = Project::where('id','=',$project_user_project_id)->pluck('project_name');
					$project_user[$loop2]['client'] = Project::where('id','=',$project_user_project_id)->pluck('project_client');
					$project_user[$loop2]['notes'] = Project::where('id','=',$project_user_project_id)->pluck('note');
					$project_user[$loop2]['description'] = Project::where('id','=',$project_user_project_id)->pluck('description');
					$project_create = Project::where('id','=',$project_user_project_id)->pluck('created_at');
					$project_updated = Project::where('id','=',$project_user_project_id)->pluck('updated_at');
					if((Project::where('id','=',$project_user_project_id)->pluck('deleted')!=null) && ($project_create == $project_updated)){
						$project_user[$loop2]['editdelete'] = 'no';
					}else{
						$project_user[$loop2]['editdelete'] = 'yes';
					}
					$loop2++;
				}
			}

			/*for($loop=0;$loop<$projects_count;$loop++){
				$projects_date[$loop]['project_name'] = Project::where('id','=',$projects_first_date+$loop)->pluck('project_name');
				$projects_date[$loop]['id'] = Project::where('id','=',$projects_first_date+$loop)->pluck('id');
			}*/

			$todaysDate = new \ExpressiveDate();
		    return \View::make('dashboard.calendar.view')
		   				->with('todaysDate',$todaysDate)
		   				->with('eventDates',$eventDates)
						->with('events', $events)
						//->with('tasks_date',json_encode($tasks_date))
						->with('projects_date',json_encode($project_user))
						//->with('tasks_day',$tasks_date)
						->with('projects_day',$project_user)
						->with('newjson',$newjson);
		
	}

	/**
	*	Add Event
	* @return Redirect
	*/
	public function addEvent()
	{
		//Get all the data
		$data = \Input::all();
		//Get the user id of the currently logged in user
		$userId =  \Sentry::getUser()->id;
		//Add event
		$result = $this->event->addEvent($data,$userId);
		return \Redirect::to('dashboard/calendar')->with('status','success')->with('message','Entry Added');
	  
	}
	/**
	* Get Events for a custom day for currently looged in user
	* @return JSON
	*/
	public function getEvents($day)
	{
		//Get the user id of the currently logged in user
		$userId =  \Sentry::getUser()->id;
		//Get the events
		$events =  $this->event->getEvents($userId,$day);
		$jsonEvents = json_encode($events);
		return  $jsonEvents;
		
	}
	/**
	*  Delete Event
	*  @return Redirect 
	*/
	public function deleteEvent()
	{
		$eventId = \Input::get('deleteEventId');
		//Get the user id of the currently logged in user
		$userId =  \Sentry::getUser()->id;
		//Check permission
		$checkpermission = $this->event->checkPermission($eventId,$userId);
		if($checkpermission)
		{
			//Authorized, Delete Event
			$result = $this->event->deleteEvent($eventId,$userId);
			if($result == 'success')
			{
				return \Redirect::to('dashboard/calendar')->with('status','success')->with('message','Entry Deleted');
			}
			else
			{
				//Something went wrong
				return \Redirect::to('dashboard/calendar')->with('status','error')->with('message','Something Went Wrong. Please try again.');
			}
		}
		else
		{
			throw new \NotAuthorizedForEventException();
		}
	}
	/**
	*  View for Edit Event
	*  @return View
	*/
	public function getEditEvent($id)
	{
		try
		{
			$event = \Events::findOrFail($id);
		}
		catch(ModelNotFoundException $e)
		{
			throw new \EventNotFoundException();
		}
		$emaillist = null;
		//Get the user id of the currently logged in user
		$userId =  \Sentry::getUser()->id;
		//Check Permission
		$checkpermission = $this->event->checkPermission($id,$userId);
		if($checkpermission)
		{
			//Authorized, Get Event
			$event = $this->event->getEvent($id);
			foreach ($event['users'] as $user)
		 	{
				if($emaillist == null)
				{
					$emaillist = $user['email'];
				}
				else
				{
					$emaillist = $emaillist.','.$user['email'];
				}
				
			}
			//Wrap Up and generate View	
			return \View::make('dashboard.calendar.edit')
					->with('emaillist',$emaillist)
					->with('event',$event);
		}
		else
		{
			throw new \NotAuthorizedForEventException();
		}
	}
	/**
	* Update Event
	* @return Redirect
	*/
	public function postEditEvent($id)
	{
		//Get all the data
		$data = \Input::all();
		//Get the user id of the currently logged in user
		$userId =  \Sentry::getUser()->id;
		//update Event
		$result = $this->event->editEvent($data,$userId);
		if($result == 'success')
		{
			//Success, Done
			return \Redirect::to('dashboard/calendar')->with('status','success')->with('message','Entry Updated');
		}
		else
		{
			//Error while updating, Notify User
			return \Redirect::to('dashboard/calendar')->with('status','error')->with('message','Something Went Wrong. Please try again.');
		}
	}
	/**
	* Get all events created by a Currently Logged on User
	* @return View
	*/
	public function getEventsCreatedByMe()
	{
		$userId = \Sentry::getUser()->id;
		$events = $this->event->getEventsCreatedByUser($userId);
        return \View::make('dashboard.calendar.createdbyme')
                    ->with('events',$events);
	}
}