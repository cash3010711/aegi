@extends('dashboard.default')
@section('head')
<title>92five app - Tasks</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content" id = "Grid">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / 任務</h2><!--dashboard可超連結至首頁(總覽)-->
        @if($tasks == null)<!--沒有task的情況下執行-->
        <div class="add_project_main">
          <div class="wrapper-demo">
            <label class="task_proj_listlabel">計劃列表: </label>
            <div class="task_filter">
              <div id="dd" class="wrapper-dropdown-5" tabindex="1">{{$projectName}}
                <ul class="dropdown">
                  <li><a href="{{url('/dashboard/tasks')}}">All</a></li>
                  @if($projects != null)
                  @foreach($projects as $project => $key)
                  <li><a href={{url('/dashboard/tasks/project',array($key['id']))}}>{{$key['project_name']}}</a></li>
                  @endforeach
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <a href="{{url('/dashboard/tasks/add')}}" class="add_project add-last"> +新增任務</a></div>
          <div class="no_project_main">
            <div class="span12">
              <div class="span12 compeleted proj-main-box">
                <div class="nodatadisplay_main">
                  <div class="nodatadisplay">
                    <h2>抱歉，目前尚無任務</h2>
                    <div class="nodata_inner">
                      <div class="nodata_left"></div>
                      <div class="nodata_right"></div>
                      <div class="nodata_detail_2"><img src="{{asset('assets/images/dashboard/smile_icon.png')}}" alt=""></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @else
			
          <div class="add_project_main">
            <a href="#"  data-filter="all" class="add_project filter active pull-left" >全部</a>
            <a href="#" data-filter="act" class="add_project filter activeproject pull-left" >進行中</a>
            <a href="#" data-filter="comp" class="add_project filter complproject pull-left" >已完成</a>
            <a href="#" data-filter="dely" class="add_project filter delayedproject pull-left" >延期</a>
            <div class="wrapper-demo">
              <label class="task_proj_listlabel">計劃列表: </label>
              <div class="task_filter">
                <div id="dd" class="wrapper-dropdown-5" tabindex="1">{{$projectName}}
                  <ul class="dropdown">
                    <li><a href="{{url('/dashboard/tasks')}}">All</a></li>
                    @if($projects != null)
                    @foreach($projects as $project => $key)
                    <li><a href={{url('/dashboard/tasks/project',array($key['id']))}}>{{$key['project_name']}}</a></li>
                    @endforeach
                    @endif
                  </ul>
                </div></div>
              </div>
              <a href="{{url('/dashboard/tasks/add')}}" class="add_project add-last"> +新增任務</a>
            </div>
            <!-- Task Listing -->
            <div class="row-fluid task_section">
              <div id="columns">
                <!-- Task Box -->
                @foreach($tasks as $task)
                @if($task['status'] == 'active')
                <div class="task_box pin mix act">
                  <div class="task_title">
                    <div class="span2 task_title_left"><input type="checkbox" id={{$task['id']}} value={{$task['id']}}  class="regular-checkbox" style="position:relative; left:5px;" /><label class="taskCheck" for={{$task['id']}}></label></div>
                    <div class="span10 task_title_link"><a href="{{url('/dashboard/tasks',array($task['id']))}}" id="taskname">{{$task['name']}} </a></div>
                  </div>
                  @if($task['num_status'] == 0)
                  <div class="row-fluid task_no_main">
                    <div class="task_no_inner" id ="task_no_inner">{{sprintf("%02s", $task['num_status'])}}</div>
                    <p><a href="#">剩餘天數</a></p>
                  </div>
                  @else
                  <div class="row-fluid task_no_main">
                    <div class="task_no_inner" id ="task_no_inner">{{sprintf("%02s", $task['num_status'])}}</div>
                    <p><a href="#">剩餘天數</a></p>
                  </div>
                  @endif
                  <div class="row-fluid sub_task">
                    <p>任務</p>
                    <div class="task_prog"> <div class="progress">
                      <div class="bar " style="width: {{$task['subTaskPercentage']}}%;"></div>
                    </div></div>
                    <p><a href="#">剩餘子任務 {{$task ['rem_subtasks']}} / {{$task ['totalsubtasks'] }} </a></p>
                  </div>
                  <div class="span12 t_proj_detail">
                    @if($task['project_id'] == null)
                    <p>計劃: <a href="#">[不屬任何計劃]</a></p>
                    @else
                    <p>計劃: <a href="{{url('dashboard/projects',array($task['project_id']))}}">{{$task['project_name']}}</a></p>
                    @endif
                    <ul class="task_list">
                      <li><a href="{{url('/dashboard/tasks',array($task['id']))}}">{{$task['files']}} 項附加文件</a></li>
                    </ul>
                    <div class="create_date"> 更新於 {{$task['updated_at']}}</div>
                  </div>
                </div>
                @endif
                @if($task['status'] == 'completed')
                <div class="task_box pin mix comp">
                  <div class="task_title">
                    <div class="span2 task_title_left"><input type="checkbox" id={{$task['id']}} class="regular-checkbox" checked style="position:relative; left:5px;" /><label  class="taskCheck" for={{$task['id']}}></label></div>
                    <div class="span10 task_title_link"><a href="{{url('/dashboard/tasks',array($task['id']))}}" id="taskname" class="task_link_select">{{$task['name']}} </a></div>
                  </div>
                  <div class="row-fluid task_no_main">
                    <div class="task_compete" id="task_compete">完成於 {{new ExpressiveDate($task['completed_on'])}}</div>
                    <p></p>
                  </div>
                  <div class="row-fluid sub_task">
                    <p>任務</p>
                    <div class="task_prog"><div class="progress">
                      <div class="bar " style="width: {{$task['subTaskPercentage']}}%;"></div>
                    </div></div>
                    <p><a href="#" class="task_link_select">剩餘子任務 {{$task ['rem_subtasks']}} / {{$task ['totalsubtasks'] }} </a></p>
                  </div>
                  <div class="span12 t_proj_detail">
                    @if($task['project_id'] == null)
                    <p>計劃: <a href="#">[不屬任何計劃]</a></p>
                    @else
                    <p>計劃: <a href="{{url('dashboard/projects',array($task['project_id']))}}">{{$task['project_name']}}</a></p>
                    @endif
                    <ul class="task_list">
                      <li><a href="{{url('/dashboard/tasks',array($task['id']))}}">{{$task['files']}} 項附加文件</a></li>
                    </ul>
                    <div class="create_date">更新於 {{$task['updated_at']}}</div>
                  </div>
                </div>
                @endif
                @if($task['status'] == '延誤')
                <div class="task_box pin mix dely">
                  <div class="task_title">
                    <div class="span2 task_title_left"><input type="checkbox" id="{{$task['id']}}" class="regular-checkbox" style="position:relative; left:5px;" /><label  class="taskCheck" taskid="{{$task['id']}}"  for="{{$task['id']}}"></label></div>
                    <div class="span10 task_title_link"><a href="{{url('/dashboard/tasks',array($task['id']))}}" id="taskname">{{$task['name']}} </a></div>
                  </div>
                  <div class="row-fluid task_no_main">
                    <div class="task_delayed" id="task_delayed">延誤</div>
                  </div>
                  <div class="row-fluid sub_task">
                    <p>任務</p>
                    <div class="task_prog"><div class="progress">
                      <div class="bar " style="width: {{$task['subTaskPercentage']}}%;"></div>
                    </div></div>
                    <p><a href="#">剩餘子任務 {{$task ['rem_subtasks']}} / {{$task ['totalsubtasks'] }} </a></p>
                  </div>
                  <div class="span12 t_proj_detail">
                    @if($task['project_id'] == null)
                    <p>計劃: <span class="no_proj_tasks"> [不屬任何計劃]</span></p>
                    @else
                    <p>計劃: <a href="{{url('dashboard/projects',array($task['project_id']))}}">{{$task['project_name']}}</a></p>
                    @endif
                    <ul class="task_list">
                      <li><a href="{{url('/dashboard/tasks',array($task['id']))}}">{{$task['files']}} 項附加文件</a></li>
                    </ul>
                    <div class="create_date">更新於 {{$task['updated_at']}}</div>
                  </div>
                </div>
                @endif
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 @if(Session::has('status') and Session::has('message') )
@if(Session::has('status') == 'success')
<script>
$(document).ready( function() {
  var url = window.location.href;
var tempurl = url.split('dashboard')[0];
iosOverlay({
    text: "{{Session::get('message')}}",
    duration: 5e3,
    icon: tempurl+'assets/images/notifications/check.png'
  });

});
</script>
{{Session::forget('status'); Session::forget('message');}}
@elseif(Session::has('status') == 'error')
<script>
$(document).ready( function() {
  var url = window.location.href;
var tempurl = url.split('dashboard')[0];
  iosOverlay({
    text: "{{Session::get('message')}}",
    duration: 5e3,
    icon: tempurl+'assets/images/notifications/cross.png'
  });
});
</script>
{{Session::forget('status'); Session::forget('message');}}
@endif
@endif
@stop
@section('endjs')
{{ HTML::style('assets/css/dashboard/dd.css') }}
{{ HTML::script('assets/js/dashboard/task.js') }}
<script>
$(function() {
  $('#Grid').mixitup({
    effects: ['blur'],
    easing: 'smooth',
    transitionSpeed: 1000,
    resizeContainer: true
  });
  var taskModel = new TaskModel()
  var taskview = new TaskView({
    model: taskModel
  });
});
function DropDown(el) {
  this.dd = el;
  this.initEvents();
}
DropDown.prototype = {
  initEvents: function() {
    var obj = this;
    obj.dd.on('click', function(event) {
      $(this).toggleClass('active');
      event.stopPropagation();
    });
  }
}
$(function() {
  var dd = new DropDown($('#dd'));
  $(document).click(function() {
    $('.wrapper-dropdown-5').removeClass('active');
  });
});
</script>
{{ HTML::script('assets/js/jquery/jquery.mixitup.js') }}
@stop

