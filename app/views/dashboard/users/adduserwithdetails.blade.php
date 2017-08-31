@extends('dashboard.default')
@section('head')
<title>92five app - Add User With Details</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard/admin')}}">系統管理員</a> / <a href="{{url('/dashboard/admin/users')}}">使用者</a>/新增使用者</h2>
        <form class="form-horizontal" method="post" id="newpassform" name="newpassform"  data-validate="parsley" >
          <div class="row-fluid change_email edit_user_sec">
            <h3>
            <div class="span6"><input type="text" name="first_name" class="edit_user_input" placeholder="姓" data-required="true"  data-show-errors="false"></div>
            <div class="span6"><input type="text" name="last_name" class="edit_user_input" placeholder="名" data-required="true"  data-show-errors="false"></div>
            </h3>
            <div class="change_email_inner">
              <div class="row-fluid">
                <div class="field_main">
                  <div class="row-fluid field_data">
                    <div class="span3 field_name">電子信箱</div>
                    <div class="span5">
                      <input type="email" id="email" name="email" class="span12 field_input" placeholder="電子信箱" data-required="true"  data-show-errors="true">
                    </div>
                    <div class="span4"></div>
                  </div>
                  <div class="row-fluid field_data">
                    <div class="span3 field_name">密碼</div>
                    <div class="span5">
                      <input type="password" id="password" name="password" class="span12 field_input" placeholder="密碼">
                    </div>
                    <div class="span4 progress_data" id="progressbar"><div id="progress"></div></div>
                  </div>
                  <div class="row-fluid field_data">
                    <div class="span3 field_name">確認密碼</div>
                    <div class="span5">
                      <input type="password" id="confirmpass" name="confirmpass" class="span12 field_input" placeholder="確認密碼">
                    </div>
                    <div class="progress_data2" id="confirmtick">
                      <div id="confirmtick_child" name="confirmtick_child"></div>
                    </div>
                  </div>
                  <div class="row-fluid field_data">
                    <div class="span3 field_name">權限</div>
                    <div class="span5">
                      <select name="role" class="global_select" id="role" tabindex="1">
                        <option  name="" value="user" title="">user</option>
                        <option  name="" value="leader" title="">leader</option>
                        <option  name="" value="manager" title="" >manager</option>
                        <option  name="" value="ganaral_manager" title="">ganaral_manager</option>
                      </select>
                    </div>
                    <div class="span4"></div>
                  </div>
                </div>
                <div class="submit_button_main editevent-button">
                  <button class="submit">新增</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 
  @stop
@section('endjs')
{{ HTML::script('assets/js/jquery/jquery.complexify.js') }}
{{ HTML::script('assets/js/jquery/jquery.complexify.banlist.js') }}
{{ HTML::script('assets/js/forgotpassword/forgotpassword.js') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
@stop