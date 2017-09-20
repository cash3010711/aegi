<?php namespace Controllers\Domain\Admin;
use October\Rain\Config\Rewrite as NewConfig;
/**
 * Admin Controller.    
 * @version    1.0.0
 * @author     Chintan Banugaria
 * @copyright  (c) 2014, 92fiveapp
 * @link       http://92fiveapp.com
 **/
class AdminController extends \BaseController{

        /**
         *
         * Get Admin Page
         */
		public function getIndex()
        {
            return \View::make('dashboard.admin.index');
        }
        /**
         * Get Email Settings Page
         */
        public function getEmailSettings()
        {   
            $userID =  \Sentry::getUser()->id;
            //Get mail settings
            $data['host'] = \Config::get('mail.host');
            $data['port'] = \Config::get('mail.port');
            $data['username'] = \Config::get('mail.username');
            $data['first_name'] = "";
            $data['last_name'] = "";
            $data['password'] = \Config::get('mail.password');
            $data['sendername'] = \Config::get('mail.from.name');
            $data['senderaddress'] = \Config::get('mail.from.address');
            $data['encryption'] = \Config::get('mail.encryption');

            $data['phone'] = \UserProfile::where('id','=',$userID)->pluck('phone');

            return \View::make('dashboard.admin.mailsettings')
                            ->with('data',$data);
        }
        /**
         * Update Mail Settings
         * @return Redirect
         */

        public function postEmailSettings()
        {
            try
            {
            $userID = \Sentry::getUser()->id;
            $data = \Input::all();
            $newMailConfig = new NewConfig;
            if($data['encryption'] == 'null')
            {
                $data['encryption'] = null;
            }
            $newMailConfig->toFile(app_path().'/config/mail.php', [
              'host' =>$data['host'],
              'port' =>$data['port'],
              'from.address' =>$data['senderaddress'],
              'from.name' =>$data['sendername'],
              'username' =>$data['username'],
              'password' =>$data['password'],
              'encryption' =>$data['encryption'], 
            ]);
            $userProfile = \UserProfile::where('id','=',$userID)->first();
            $userProfile->phone = $data['phone'];
            $userProfile->save();

            return \Redirect::to('dashboard/admin')->with('status','success')->with('message','Settings Updated');
            }
            catch (\Exception $e)
            {
                \Log::error('Something Went Wrong in Admin Controller - postEmailSettings():'.$e->getMessage());
                return \Redirect::to('dashboard/admin')->with('status','error')->with('message','Something Went Wrong123123S');
            }
        }

        public function getEmailSettings_general()
        {
            $userID =  \Sentry::getUser()->id;
           // Get mail settings
            $data['host'] = \Sentry::getUser()->email;
            $data['port'] = "";
            $data['username'] = "";
            $data['first_name'] = \Sentry::getUser()->first_name;
            $data['last_name'] = \Sentry::getUser()->last_name;
            $data['password'] = "";
            $data['sendername'] = "";
            $data['senderaddress'] = "";
            $data['encryption'] = "";
            $data['phone'] = \UserProfile::where('id','=',$userID)->pluck('phone');
            return \View::make('dashboard.admin.mailsettings')
                            ->with('data',$data);
        }

        public function postEmailSettings_general()
        {
            try
            {
            $userID = \Sentry::getUser()->id;
            $user = \Sentry::findUserByLogin(\Sentry::getUser()->email);
            $data = \Input::all();
            
            $user->email = $data['host'];
            $user->password = $data['password'];
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->save();

            $userProfile = \UserProfile::where('id','=',$userID)->first();
            $userProfile->phone = $data['phone'];
            $userProfile->save();
            
            return \Redirect::to('dashboard')->with('status','success')->with('message','Settings Updated');
            }
            catch (\Exception $e)
            {
                \Log::error('Something Went Wrong in Admin Controller - postEmailSettings_general():'.$e->getMessage());
                return \Redirect::to('dashboard/admin')->with('status','error')->with('message','Something Went Wrong123123S');
            }
        }

}