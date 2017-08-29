@extends('dashboard.default')
@section('head')
<title>92five app - Reports</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / 報表</h2>
        <!-- Reports Section -->
        <div class="row-fluid reports-sec">
          <div class="span3 report-box">
            <h3>該週回報</h3>
            <div class="report-image"><a href="#" ><img id="weeklytoggle" src="{{asset('assets/images/reports/weekly_icon.png')}}" alt=""></a></div>
            <ul  id="weeklytoggledata" class="admin_listing hide">
              <li><a  data-toggle="modal" href="#myModal-weeklyall">一週完整回報</a></li>
              <li><a data-toggle="modal" href="#myModal-weeklytask">一週任務回報</a></li>
              <li><a data-toggle="modal" href="#myModal-weeklyproject">一週計劃回報</a></li>
            </ul>
          </div>
          <div class="span3 report-box">
            <h3>該月回報</h3>
            <div class="report-image"><a href="#"><img id="monthlytoggle" src="{{asset('assets/images/reports/monthly_icon.png')}}" alt=""/></a></div>
            <ul id="monthlytoggledata" class="admin_listing hide">
              <li><a  data-toggle="modal" href="#myModal-monthlyall">月份完整回報</a></li>
              <li><a data-toggle="modal" href="#myModal-monthlytask">月份任務回報</a></li>
              <li><a data-toggle="modal" href="#myModal-monthlyproject">月份計劃回報</a></li>
            </ul>
          </div>
          <div class="span3 report-box">
            <h3>計劃回報</h3>
            <div class="report-image"><a  data-toggle="modal" href="#myModal-projectreport"><img src="{{asset('assets/images/reports/project_report_icon.png')}}" alt=""></a></div>
          </div>
          @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')) or Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('manager')) or Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('leader')) or Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('ganaral_manager')))
          <div class="span3 report-box">
            <h3>人員回報</h3>
            <div class="report-image"><a  data-toggle="modal" href="#myModal-monthlyuserproject"><img src="{{asset('assets/images/reports/userreport.png')}}" alt=""></a></div>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Start Weekly All template -->
<div id="myModal-weeklyall" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">一週完整回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/weekly')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該週的其中一天</label>
                      <input id="date" name="date" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        <button class="submit">提交</a></button>
      </form>
    </div>
  </div>
</div>
 <!-- End Weekly All Tempate -->
<!-- Start Weekly Task template -->
<div id="myModal-weeklytask" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">一週任務回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/weeklytask')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    @if($tasks != null)
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該週的其中一天</label>
                      <input id="weektaskdate" name="weektaskdate" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @else
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該週的其中一天</label>
                      <input id="weektaskdate" name="weektaskdate" disabled type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @endif
                  </div>
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇任務</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($tasks != null)
                            <select name="task" id="task" tabindex="1" style="width:270px;">
                              @foreach($tasks as $task)
                              <option  name="" value={{$task['id']}} title="">{{$task['name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="task" id="task" disabled tabindex="1" style="width:270px;">
                              <option  name="" value="others" title="">目前沒有任務</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($tasks !=null)
            <button class="submit">提交</button>
            @else
            <button class="submit" disabled>提交</button>
            @endif
          </form>
        </div>
      </div>
    </div>
<!-- End Weekly Task Tempate -->
<!-- Weekly Project template -->
<div id="myModal-weeklyproject" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">一週計劃回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/weeklyproject')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    @if($projects != null)
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該週的其中一天</label>
                      <input id="weekprojectdate" name="weekprojectdate" type="text" class="span6 pull-left" placeholder="Date" data-required="true" data-trigger="change">
                    </div>
                    @else
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該週的其中一天</label>
                      <input id="weekprojectdate" name="weekprojectdate" disabled type="text" class="span6 pull-left" placeholder="Date" data-required="true" data-trigger="change">
                    </div>
                    @endif
                  </div>
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇計劃</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($projects != null)
                            <select name="project" id="project" tabindex="1" style="width:270px;">
                              @foreach($projects as $project)
                              <option  name="" value={{$project['id']}} title="">{{$project['project_name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="project" id="project" disabled tabindex="1" style="width:270px;">
                              <option  name="" value="others" title="">目前沒有計劃</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($projects != null)
          <button class="submit">提交</a></button>
          @else
          <button class="submit" disabled>提交</button>
          @endif
        </form>
      </div>
    </div>
  </div>
<!-- End Weekly Project Template -->
<!-- Monthly All template -->
<div id="myModal-monthlyall" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">月份完整回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/monthly')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇月份</label>
                      <input id="monthall" name="monthall" type="text" class="span6 pull-left" placeholder="選擇其中一天" data-required="true" data-trigger="change">
                    </div>
                  </div>
                </fieldset>
              </div>
            </div>
          </div>
        <button class="submit">提交</a></button>
      </form>
    </div>
  </div>
</div>
<!-- End Monthly All Tempate -->
<!-- Monthly Task Template -->
<div id="myModal-monthlytask" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">月份任務回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/monthlytask')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    @if($tasks != null)
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該月其中一天</label>
                      <input id="monthtaskdate" name="monthtaskdate" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @else
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該月其中一天</label>
                      <input id="monthtaskdate" name="monthtaskdate" disabled type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @endif
                  </div>
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇任務</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($tasks != null)
                            <select name="monthtask" id="monthtask" tabindex="1" style="width:270px;">
                              @foreach($tasks as $task)
                              <option  name="" value={{$task['id']}} title="">{{$task['name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="monthtask" id="monthtask" disabled tabindex="1" style="width:270px;">
                              <option  name="" value="others" title="">目前沒有任務</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($tasks != null)
            <button class="submit">提交</button>
            @else
            <button class="submit" disabled>提交</button>
            @endif
          </form>
        </div>
      </div>
    </div>
<!-- End Monthly Task Template -->
<!-- Monthly Project Template -->
<div id="myModal-monthlyproject" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">月份計劃回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/monthlyproject')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    @if($projects != null)
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該月其中一天</label>
                      <input id="monthprojectdate" name="monthprojectdate" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @else
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇該月其中一天</label>
                      <input id="monthprojectdate"  disabled name="monthprojectdate" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                    @endif
                  </div>
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇計劃</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($projects != null)
                            <select name="monthproject" id="monthproject" tabindex="1" style="width:270px;">
                              @foreach($projects as $project)
                              <option  name="" value={{$project['id']}} title="">{{$project['project_name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="monthproject" id="monthproject" disabled tabindex="1" style="width:270px;">
                              <option  name="" value="others" title="">目前沒有計劃</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($projects != null)
          <button class="submit">提交</a></button>
          @else
        <button class="submit" disabled>提交</a></button>
        @endif
      </form>
    </div>
  </div>
</div>
<!-- End Monthly Project Template -->
<!-- Project Report Template -->
<div id="myModal-projectreport" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">計劃回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/projectreport')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇計劃</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($projects != null)
                            <select name="projectid" id="projectid" tabindex="1" style="width:270px;">
                              @foreach($projects as $project)
                              <option  name="" value={{$project['id']}} title="">{{$project['project_name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="projectid" disabled id="projectid" tabindex="1" style="width:270px;">
                              <option  name="" value="others" title="">目前沒有計劃</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($projects != null)
            <button class="submit">提交</button>
            @else
            <button class="submit" disabled>提交</button>
            @endif
          </form>
        </div>
      </div>
    </div>
<!-- End Project Report Template -->
<!-- Monthly User Project Template -->
<div id="myModal-monthlyuserproject" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">人員回報</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/reports/usermonthlyproject')}}" method='post' data-validate="parsley">
        <div class="modal-body">
          <div class="popup_event">
            <div class="add-proj-form">
              <fieldset>
                <div class="row-fluid">
                  <div class="control-group">
                    <div class="row-fluid">
                      <label class="control-label" for="passwordinput">選擇計劃中的一天</label>
                      <input id="userprojectdate" name="userprojectdate" type="text" class="span6 pull-left" placeholder="日期" data-required="true" data-trigger="change">
                    </div>
                  </div>
                  <div class="row-fluid">
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇計劃</label>
                        <div class="controls">
                          <div class="task_select">
                            @if($projects != null)
                            <select name="projectmonth" id="projectmonth" tabindex="1" style="width:270px;" data-required="true" data-trigger="change">
                              <option  name="" value="" title="" selected>選擇計劃</option>
                              @foreach($projects as $project)
                              <option  name="" value={{$project['id']}} title="">{{$project['project_name']}}</option>
                              @endforeach
                            </select>
                            @else
                            <select name="projectmonth" disabled id="projectmonth" tabindex="1" style="width:270px;" data-required="true" data-trigger="change">
                              <option  name="" value="others" title="">目前沒有計劃</option>
                            </select>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="row-fluid">
                        <label class="control-label" for="passwordinput">選擇人員</label>
                        <div class="controls">
                          <div class="task_select">
                            <select name="userprojectreportid" id="userprojectreportid" tabindex="1" data-required="true" data-trigger="change" disabled style="width:270px;">
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            @if($projects != null)
          <button class="submit">提交</a></button>
          @else
        <button class="submit" disabled>提交</a></button>
        @endif
      </form>
    </div>
  </div>
</div>
<!--  End Monthly User Project Template -->
@stop
@section('endjs')
{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/dashboard/projectusers.js') }}
<script>
$(function() {
  var userCollection = new UserCollection();
  var userView = new UserView({
    model: userCollection
  });
});
$('#date').pickadate({
  formatSubmit: 'yyyy-mm-dd'
});
$('#weektaskdate').pickadate({
  formatSubmit: 'yyyy-mm-dd'
});
$('#weekprojectdate').pickadate({
  formatSubmit: 'yyyy-mm-dd'
});
$('#monthall').pickadate({
  format: 'mmmm, yyyy',
  formatSubmit: 'yyyy-mm'
});
$('#monthtaskdate').pickadate({
  format: 'mmmm, yyyy',
  formatSubmit: 'yyyy-mm'
});
$('#monthprojectdate').pickadate({
  format: 'mmmm, yyyy',
  formatSubmit: 'yyyy-mm'
});
$('#userprojectdate').pickadate({
  format: 'mmmm, yyyy',
  formatSubmit: 'yyyy-mm'
});
$(document).ready(function() {
  $('#weeklytoggle').click(function() {
    $("#weeklytoggledata").slideToggle();
  });
  $('#monthlytoggle').click(function() {
    $("#monthlytoggledata").slideToggle();
  });
});
</script>
@stop