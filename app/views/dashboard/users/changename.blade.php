@extends('dashboard.default')
@section('head')
<title>92five app - Change Email</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">Dashboard</a> / {{$breadCrumb}}</h2>
        <div class="row-fluid change_email">
          @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('ganaral_manager')) and $can_change)
            <h1><center>您無權更改此使用者姓名</center></h1>
          @else
          <form method='post' id="emailForm"  data-validate="parsley" >
            <h3>Change name</h3>
            <div class="change_email_inner">
              <div class="email_detail_1">
                <div class="email_detail_2">
                  <div class="span5 email_name">Current first name:</div>
                  <div class="span7">{{$oldfirst}}</div>
                  <div class="email_detail_2">
                  <div class="span5 email_name">Current last name:</div>
                  <div class="span7">{{$oldlast}}</div>
                </div>
                <div class="email_detail_2">
                  <div class="span5 email_name">New first name:</div>
                  <div class="span7"><input type="textarea" id="newfirst_name" placeholder="New fisrtname" class="span12" name="newfirst_name" data-required="true"  data-show-errors="true"></div>
                  <div class="email_detail_2">
                  <div class="span5 email_name">New last name:</div>
                  <div class="span7"><input type="textarea" id="newlast_name" placeholder="New lastname" class="span12" name="newlast_name" data-required="true"  data-show-errors="true"></div>
                </div>
                @if($showNote == true)
                <p>Please note that a link will be sent to verify your new email address.  Only after verifying the new  email, your account will be activated again.</p>
                @endif
                <input type="hidden" name="userId" id="userId" value="{{$userId}}"/>
                <input type="hidden" name="oldfirst" id="oldfirst" value="{{$oldfirst}}"/>
                <input type="hidden" name="oldlast" id="oldlast" value="{{$oldlast}}"/>
                <div class="submit_button_main editevent-button">
                  <button class="submit">Update</button>
                </div>
              </div>
            </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop
