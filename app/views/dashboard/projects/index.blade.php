@extends('dashboard.default')
@section('head')
<title>計畫</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content" id = "Grid">
    <div class="row-fluid" >
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / 計畫</h2>
        <div class="add_project_main">
          @if($data != null)
          <a href="#" data-filter="all" class="add_project filter active pull-left" >全部</a>
          <a href="#" data-filter="p_active" class="add_project activeproject filter pull-left" >進行中</a>
          <a href="#" data-filter="compeleted" class="add_project complproject filter pull-left" >已完成</a>
          <a href="#" data-filter="delayed" class="add_project delayedproject filter pull-left" >延期</a>
          @endif
		  
          @if(Sentry::getUser()->hasAccess('project.create'))
          <a href="{{url('/dashboard/projects/add')}}" class="add_project add-last"> +新增計畫 </a><!--新增project按鈕-->
          @endif
        </div>
        <div class="project_box" >
          @if($data == null)<!--$data為project內容 此if為沒有project的情況下執行-->
          <div class="nodatadisplay_main">
            <div class="nodatadisplay">
              <h2>Sorry. Couldn't find any project for you.</h2>
              <div class="nodata_inner">
                <div class="nodata_left"></div>
                <div class="nodata_right"></div>
                <div class="nodata_detail_2"><img src="{{asset('assets/images/dashboard/smile_icon.png')}}" alt=""></div>
              </div>
            </div>
          </div>
		  
          @else
          @foreach($data as $project)<!--把project全部撈出來(不管active completed delayed)-->
          @if($project['status']=='active')<!--project執行中-->
          <!-- active Box --><!--顯示project內容-->
          <div class="span4 mix p_active proj-main-box">
            <h4><span class="p-proj-title"><a href="{{url('/dashboard/projects',array($project['id']))}}">{{$project['project_name']}}</a></span><!--project標題-->
            </h4>
            <div class="row-fluid">
              <div class="span12 a_detail_main">
                <div class="row-fluid">
                  <div class="span12 status_a">狀態 : 進行中</div>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12 a_detail_main">
                <div class="row-fluid">
                  <div class="span6 project_manager">開始時間: <span>{{new ExpressiveDate($project['start_date'])}}</span></div>
                  <div class="span6 project_manager a_end_date">結束時間:
                  <span>{{new ExpressiveDate($project['end_date'])}}</span></div>
                </div>
              </div>
            </div>
            <div class="complete_image"><input class="proj_knob" data-width="190" data-min="0" data-bgColor="#F2F2F2" data-fgColor="#ee8e11" data-thickness=".2" data-displayPrevious=true data-readOnly=true value={{$project['percentage']}}></div>
            <div class="row-fluid assign_list">
              <h5>被指派的任務:</h5>
              <ul>
                <li><a href="{{url('dashboard/tasks')}}">剩餘任務數:{{$project['my_rem_task']}} 總共任務數:{{$project['my_total_task']}} </a></li>
              </ul>
            </div>
            <div class="row-fluid assign_list">
              <h5>全部的任務:</h5>
              <ul>
                <li><a href="{{url('dashboard/tasks/project',array($project['id']))}}">剩餘任務數:{{$project['overall_rem_task']}} 總共任務數:{{$project['overall_task']}} </a></li>
              </ul>
            </div>
          </div>
		  
          @elseif($project['status'] =='completed')<!--project已完成-->
          <div class="span4 mix compeleted proj-main-box">
            <h4><span class="p-proj-title"><a href={{url('/dashboard/projects',array($project['id']))}}>{{$project['project_name']}}</a></span>
            </h4>
            <div class="row-fluid">
              <div class="span12 a_detail_main">
                <div class="row-fluid">
                  <div class="span12 status_c">Status: Completed</div>
                </div>
              </div>
            </div>
            <div class="complete_image c_image"><input class="proj_knob" data-width="190" data-min="0" data-bgColor="#F2F2F2" data-fgColor="#2a6d1a" data-thickness=".2" data-displayPrevious=true data-readOnly=true value={{$project['percentage']}}></div>
            <div class="complete_task">Completed on <br> {{new ExpressiveDate($project['completed_on'])}}</div>
          </div>
		  
          @elseif($project['status'] == 'delayed')
          <div class="span4 mix delayed proj-main-box">
            <h4><span class="p-proj-title"><a href={{url('/dashboard/projects',array($project['id']))}}>{{$project['project_name']}}</a></span>
            </h4>
            <div class="row-fluid">
              <div class="span12 a_detail_main">
                <div class="row-fluid">
                  <div class="span12 status_d">Status: Delayed</div>
                </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12 a_detail_main">
                <div class="row-fluid">
                  <div class="span6 project_manager">Start Date: <span>{{new ExpressiveDate($project['start_date'])}}</span></div>
                  <div class="span6 project_manager a_end_date">End Date: <span>{{new ExpressiveDate($project['end_date'])}}</span></div>
                </div>
              </div>
            </div>
            <div class="complete_image"><input class="proj_knob" data-width="190" data-min="0" data-bgColor="#F2F2F2" data-fgColor="#ca0505" data-thickness=".2" data-displayPrevious=true data-readOnly=true value={{$project['percentage']}}></div>
            <div class="row-fluid assign_list">
              <h5>Assigned to me:</h5>
              <ul>
                <li><a href="{{url('dashboard/tasks')}}">{{$project['my_rem_task']}} of {{$project['my_total_task']}} tasks remaining  </a></li>
              </ul>
            </div>
            <div class="row-fluid assign_list">
              <h5>Overall :</h5>
              <ul>
                <li><a href="{{url('dashboard/tasks/project',array($project['id']))}}">{{$project['overall_rem_task']}} of {{$project['overall_task']}} tasks remaining </a></li>
              </ul>
            </div>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  
@if(Session::has('status') == 'success')
<script>
$(document).ready( function() {
  var url = window.location.href;
var tempurl = url.split('dashboard')[0];
iosOverlay({
    text: "{{Session::get('message')}}",				  //提示訊息; message內的東西為project add
    duration: 5e3,										  //提示時間長短
    icon: tempurl+'assets/images/notifications/check.png' //圖片顯示
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
@stop
@section('endjs')
{{ HTML::script('assets/js/jquery/jquery.blockUI.js') }}
{{ HTML::script('assets/js/jquery/jquery.knob.js') }}
{{ HTML::script('assets/js/dashboard/taskcompleted.js') }}
{{ HTML::script('assets/js/jquery/jquery.mixitup.js') }}
<script>
$(function() {

  $('.project_box').mixitup({
    effects: ['fade']
  });

});
</script>
@stop

