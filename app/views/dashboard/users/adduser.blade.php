@extends('dashboard.default')
@section('head')
<title>92five app - Add User</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a>/ <a href="{{url('/dashboard/admin')}}">系統管理員</a> / <a href="{{url('/dashboard/admin/users')}}">使用者</a> / 新增使用者</h2>
        <div class="row-fluid change_email">
          <form class="form-horizontal" method="post" data-validate="parsley">
            <div class="adduser_sec">
              <p>輸入您要添加的用戶的電子郵件地址</p>
              <div class="email_detail_2">
                <div class="span6"><input type="text" placeholder="電子信箱" class="span12" name="email"data-required="true"  data-show-errors="true"></div>
                <div class="task_select span4">
                  <select name="role" class="global_select" id="role" tabindex="1">
                    <option  name="" value="user" title="">一般使用者</option>
                    <option  name="" value="leader" title="">主管</option>
                    <option  name="" value="manager" title="" >經理</option>
                  </select>
                </div>
                <div class="span2">
                  <button class="submit pull-left">新增</button>
                </div>
                <div class="adduserwithdetails"><a href="{{url('dashboard/admin/users/add/withdetails')}}">添加詳細資料(建議使用)</a></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  @stop
  @section('endjs')
  {{ HTML::script('assets/js/simplelogin/parsley.js') }}
  {{ HTML::style('assets/css/simplelogin/parsley.css') }}
  @stop

