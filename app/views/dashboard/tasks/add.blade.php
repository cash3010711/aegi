@extends('dashboard.default')
@section('head')
<title>92five app - Add Task</title>
@stop
@section('content')

<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard/tasks')}}">任務</a> / 新增任務</h2>
        <!-- Add New Task -->
        <div class="row-fluid add_new_task">
          <div class="span7 add_new_task_left" id="add_new_task_left">
            <form class="form-horizontal" action="#" id="newtaskform" method="post"  data-validate="parsley"  >
              <h3>
              <input type="text" name="task_name" id="task_name" class="task_create_in" value="" placeholder="任務名稱 (必填)" data-required="true" data-show-errors="false"><!--任務名 task_name-->
              </h3>
              <div class="add-proj-form add_task_form">
                <fieldset>

                <input type="hidden" name="user_email" id="user_email" value = {{Sentry::getUser()->email}}><!--修改-->

                  <div class="control-group">
                    <label>計劃:
                      <p class="help-block"></p>
                    </label>
                    <select name="projectlist" id="projectlist" class="projectlist" tabindex="1"><!--專案名 projectlist-->
                      <option name="" value="null" selected="selected" title="">無</option>
                      @if($projects != null)
                      @foreach($projects as $project)
                      <option name="" value="{{$project['id']}}" title="">{{$project['project_name']}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="control-group">
                    <label>期限: 
                    </label><p>
                    <input id="startdate" name="startdate" type="text" class="span6 pull-left" placeholder="開始時間" data-required="true" data-trigger="change"><!--開始時間 startdate-->
                    <input id="enddate" name="enddate" type="text" class="span6 pull-right"  class="span6 pull-right" placeholder="結束時間" data-required="true" data-trigger="change"><!--結束時間 enddate-->
                  </div>
                  <div class="control-group">
                    <label>注意事項: <p>
                      <p class="help-block">
                    </label>
                    <textarea id="note" class="add-proj-form-t" placeholder="注意事項"></textarea><!--注意事項 note-->
                  </div>
                  <div class="control-group">
                    <label for="passwordinput">參與者:<span class="tooltipster-icon" title="To add the asignee start typing the name and select the appropriate user from the list. Please note that only those name will appear in list who are registered in the app. Please add your name as well if you are one of them.">(?)</span></label>
                    <div class="controls" style="margin:0;">
                      <div class="span12 flatui-detail" style="position:relative;">
                        <input id="plugin" name="passwordinput" type="text" placeholder="新增名字">
                      </div>
                      <div id="selected">
                        <ul id="list">
                        </ul>
                        <input style="display: none;" name="tagsinput" id="tagsinput" class="tagsinput" placeholder="Add Name" value="" /><!--受派人員 tagsinput-->
                        <p></p>
                        
                      </div>
                    </div>
                  </div>
                  <h4>本人是否參與本計劃 ?
                    <input type="radio" name="join_task" value="yes" checked=true>是
                    <input type="radio" name="join_task" value="no" >否
                  </h4>
                  <div class="add_task_button_main"><button  class="add_task_submit">新增任務</button></div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="span5 add_new_task_right" id="add_new_task_right" >
            <h3>新增子任務</h3>
            <div class="add-proj-form add_task_form" >
              <form class="form-horizontal" id="newsubtaskform" method="post">
                <input id="subtasks"  name="" type="text" placeholder="子任務"><!--子任務 subtasks-->
              </form>
              <input style="display: none;" name="taskId" id="taskId" class="tagsinput"  value="" />
              <div class="row-fluid sub_task_list_main">
                <div class="row-fluid">
                  <div class="span12 sub_task_data selected">
                    <ul id="subtasklist">
                    </ul>
                  </div>
                </div>
                <script>
                function foo () {
                  var projectlist_index = document.getElementById("projectlist").value;
                  var projectlist_text=document.getElementById("projectlist");
                  var projectlist_encode=encodeURIComponent(projectlist_text.options[projectlist_text.selectedIndex].text);

                  var task_name = encodeURIComponent(document.getElementById("task_name").value);
                  var startdate = encodeURIComponent(document.getElementById("startdate").value);
                  var enddate = encodeURIComponent(document.getElementById("enddate").value);
                  var note = encodeURIComponent(document.getElementById("note").value);
                  var tagsinput = encodeURIComponent(document.getElementById("tagsinput").value);
                  var subtasks = encodeURIComponent(document.getElementById("subtasks").value); 
                  window.open(`../../app/views/dashboard/send.php?task_name=${task_name}&projectlist=${projectlist_encode}&startdate=${startdate}&enddate=${enddate}&note=${note}&tagsinput=${tagsinput}&subtasks=${subtasks}`, 
                  '',config='height=300,width=450,toolbar=no, status=no, menubar=no, resizable=no, scrollbars=no');
                }
                function task_name(){
                  var task_name = encodeURIComponent(document.getElementById("task_name").value);
                  return task_name;
                }
                </script>
                                
                <div class="add_task_button_main">
                <form method="post" action="">
                  <input type="hidden" name="task_name_out" id="task_name_out" value="hello"/>
                  <a  href="#" class="add_project" id="taskfiles">新增檔案</a> <!--done-->
                  <!-- <input type="submit" value="Add files2" class="add_project" id="taskfiles"> -->
                  <!--<a href="{{url('/dashboard/task/added')}}" class="add_project" onclick="foo()">I am done here.</a>no done-->
                  <a href="{{url('/dashboard/task/added')}}" class="add_project" onclick="foo()">完成</a><!--no done-->
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  @stop
  @section('endjs')
  {{ HTML::script('assets/js/jquery/jquery.blockUI.js') }}
  {{ HTML::script('assets/js/dashboard/addtask.js') }}
  <script>
 $(document).on("click", ".removeme", function() {
   var email = $(this).parent('li').attr('email');
   var emaillist = $('#tagsinput').val();
   newemaillist = $.grep(emaillist.split(','), function(v) {
     return v != email;
   }).join(',');
   $(this).parent().remove();
   $('#tagsinput').val(newemaillist);
 });
 $('#add_new_task_right').block({
   message: null
 });
 $(function() {
   var addTaskModel = new AddTaskModel();
   var addTaskview = new AddTaskView({
     model: addTaskModel
   });
 });
</script>

{{ HTML::style('assets/css/dashboard/backbone.autocomplete.css') }}
{{ HTML::script('assets/js/dashboard/backbone.autocomplete.js') }}
{{ HTML::script('assets/js/dashboard/projectuserlist.js') }}
{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/dashboard/addtask.js') }}
{{ HTML::script('assets/js/dashboard/datecheck.js') }}
<script>
$(document).ready(function() {
            $('.tooltipster-icon').tooltipster();
        });
</script>
  @stop

