@extends('dashboard.default')
@section('head')
<title>92five app - Roles</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / 權限</h2>

        <div class="row-fluid roles_detail_main">
          <div class="span3 roles_detail">
            <h2>User</h2>
            <div class="roles_detail_2">
              <ul>
              <li>- 管理任務(新增、刪除、修改)</li>   
              <li>- 可修改自己的帳號資料 </li> 
              <li>- 管理時程表 </li> 
              <li>- 可指派任務</li> 
              <li>- 可產生週/月報表</li> 
             </ul>
              @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('user')))
              <div class="roles_name">{{Sentry::getUser()->first_name.' '. Sentry::getUser()->last_name}}</div>
              @endif
            </div>
          </div>

          <div class="span3 roles_detail">
            <h2>Leader</h2>
            <div class="roles_detail_2">
               <ul>
              <li>- 擁有user所有權力</li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ </li>
              <li>- 可管理計畫中的任務</li> 
              <li>- 可修改計畫內容</li>
              <li>- 可產生完整的計劃報表</li> 
              <li>- 可產生user的計畫報表</li>

             </ul>
              @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('leader')))
              <div class="roles_name">{{Sentry::getUser()->first_name.' '. Sentry::getUser()->last_name}}</div>
              @endif
            </div>
          </div>
          
          <div class="span3 roles_detail">
            <h2>Manager</h2>
            <div class="roles_detail_2">
             <ul>
              <li>- 擁有Leader所有權力</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ </li>
              <li>- 可新增、刪除計畫</li>
             </ul>
              @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('manager')))
              <div class="roles_name">{{Sentry::getUser()->first_name.' '. Sentry::getUser()->last_name}}</div>
              @endif
            </div>
          </div>

          <div class="span3 roles_detail">
            <h2>General_Manager</h2>
            <div class="roles_detail_2">
               <ul>
              <li>- 擁有Manager所有權力</li>
              <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+ </li>
              <li>- 可新增、刪除、修改自身位階以下的使用者資料</li> 
              <li>- 可將自身位階以下的使用者停權</li> 
              <li>- 可刪除、恢復所有計畫、任務、行程</li>
             </ul>
              @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('leader')))
              <div class="roles_name">{{Sentry::getUser()->first_name.' '. Sentry::getUser()->last_name}}</div>
              @endif
            </div>
          </div>

          <div class="span3 roles_detail">
            <h2>Admin</h2>
            <div class="roles_detail_2">
              <ul>
                 <li>- 擁有所有權力</li>            
              </ul>
              @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))
              <div class="roles_name">{{Sentry::getUser()->first_name.' '. Sentry::getUser()->last_name}}</div>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('endjs')

@stop

