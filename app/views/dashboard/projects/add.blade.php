@extends('dashboard.default')
@section('head')
<title>92five app - Add Project</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard/projects')}}">計畫</a> / 新增計畫</h2>
        <div class="row-fluid proj_create">
          <form class="" action='add' method='post' id="addproject"  data-validate="parsley" ><!--action='add'  ../../app/views/dashboard/send.php-->
            <h3><input type="text" name="project_name" id="project_name" class="proj_create_in" value="" placeholder="計劃名稱 (必填)" data-required="true" data-show-errors="false"> <div class="p-icon-main"><!--專案名 project_name-->
          </div></h3>
          <div class="row-fluid span12 proj_create_detail">
            <div class="row-fluid">
              <!-- Left Part -->
              <div class="span7 add-proj-form form-horizontal">
                <fieldset>
                  <div class="control-group">
                    <label>計劃內容:
                      <p class="help-block"></p>
                    </label>
                    <textarea class="add-proj-form-t" placeholder="計劃內容" name="description" id="description"></textarea><!--主旨 description-->
                  </div>
                  <div class="control-group">
                    <label>期限:
                    </label>
                    <input id="startdate" name="startdate" type="text" class="span6 pull-left" placeholder="開始時間" data-required="true" data-trigger="change" ><!--開始時間 Startdate-->
                    <input id="enddate" name="enddate" type="text"  class="span6 pull-right" placeholder="結束時間" data-required="true" data-trigger="change" ><!--結束時間 Enddate-->
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="passwordinput">客戶:
                      <p class="help-block"></p>
                    </label>
                    <div class="controls">
                      <input id="project_client" name="project_client" type="text" placeholder="客戶"><!--客戶 project_client-->
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="passwordinput">注意事項:
                      <p class="help-block"></p>
                    </label>
                    <div class="controls">
                      <textarea class="add-proj-form-t" placeholder="注意事項" id="note" name="note"></textarea><!--注意事項 note-->
                    </div>
                  </div>
                </fieldset>
              </div>
              <!-- Right Part -->
              <div class="span5 add_proj_right add-proj-form">
                <div class="control-group col">
                  <label class="control-label" for="passwordinput">參與者:<span class="tooltipster-icon" title="To add the collaborator start typing the name and select the appropriate from the list. Please note that only those name will appear in the list who are registered in the app. Please add your name as well if you are one of them.">?</span></label>
                  <div class="controls">
                    <div class="span12 flatui-detail">
                      <input id="plugin" name="passwordinput" type="text" placeholder="新增姓名" >
                    </div>
                    <div id="selected">
                      <ul id="list">
                      </ul>
                      <input style="display: none;" name="tagsinput" id="tagsinput" class="tagsinput"  placeholder="Add Name" value="" /><!--參與者 tagsinput-->
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="submit_button_main"><button class="submit" >新增該計劃</a></button></div>
            <!-- <div class="submit_button_main"><button class="submit" onclick=`window.open('../../app/views/dashboard/send.php?project_name=${document.getElementById("project_name").value}', '',config='height=300,width=450,toolbar=no, status=no, menubar=no, resizable=no, scrollbars=no')` >Submit</a></button></div>-->
			<!-- <input type="submit" value="submit" name="submit" onclick="window.open('../../app/views/dashboard/send.php?project_name=123', '',config='height=300,width=450,toolbar=no, status=no, menubar=no, resizable=no, scrollbars=no')"> -->
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@stop
@section('endjs')
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
 $("#addproject").submit(function(e) {
   if ($("#tagsinput").val() == '') {
     alert('Atleast add one Collaborator');
     e.preventDefault();
   }
 }); 
 /*function getvalue (){
   return document.getElementByName("project_name").value;
 }*/
 
</script>

{{ HTML::style('assets/css/dashboard/pickadate.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.date.css') }}
{{ HTML::style('assets/css/dashboard/pickadate.time.css') }}
{{ HTML::style('assets/css/dashboard/backbone.autocomplete.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/dashboard/legacy.js') }}
{{ HTML::script('assets/js/dashboard/picker.js') }}
{{ HTML::script('assets/js/dashboard/picker.date.js') }}
{{ HTML::script('assets/js/dashboard/backbone.autocomplete.js') }}
{{ HTML::script('assets/js/dashboard/userlist.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
{{ HTML::script('assets/js/dashboard/datecheck.js') }}
<script>
$(document).ready(function() {
  $('.tooltipster-icon').tooltipster();
});
</script>
  @stop

