@extends('dashboard.default')
@section('head')
<title>92five app - All Users</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard/admin')}}">系統管理員</a> / 使用者</h2>
        <div class="add_project_main">
          <a href="{{url('dashboard/admin/users/add')}}" class="add_project add-last">+ &nbsp;新增使用者</a>
        </div>
        <?php $i = 0; ?>
        @if(sizeof($data)!=0)
        @foreach($data as $user)
        <?php
        if($i == 0)
        {
        echo ('<div class="viewuser_sec">
          <div class="row-fluid">');
            }
            ?>
            <div class="span4 viewuser">
              <div class="viewuser_detail_1">
                <div class="viewuser_no">{{$user['id']}}</div>
                <div class="changedeleteusers">
                  <input type="hidden" value ="{{$role}}">
                  @if( (($user['role'] != 'admin' and $user['role'] != 'ganaral_manager') or $user['id'] == $userid) or $role == 'admin')
                  <a class="user_edit" href="{{url('dashboard/admin/users/changepassword',array($user['id']))}}">密碼更改</a>
                  <a class="user_delete" userid="{{$user['id']}}" href="#">刪除</a>
                  @endif
                </div>
              </div>

              <div class="viewuser_email"><h3>{{$user['last_name']}}  
              @if( (($user['role'] != 'admin' and $user['role'] != 'ganaral_manager') or $user['id'] == $userid) or $role == 'admin')
              <a href="{{url('/dashboard/admin/users/changename',array($user['id']))}}" class="p-icon-2" title="Change Email">
              <img src="{{asset('assets/images/dashboard/p-edit.png')}}" height="15px" width="15px" alt=""></a>
              @endif
              </h3></div>

              <div class="viewuser_email">帳號：{{$user['email']}}
              @if( (($user['role'] != 'admin' and $user['role'] != 'ganaral_manager') or $user['id'] == $userid) or $role == 'admin') 
              <a href="{{url('/dashboard/admin/users/changeemail',array($user['id']))}}" class="p-icon-2" title="Change Email">
              <img src="{{asset('assets/images/dashboard/p-edit.png')}}" height="15px" width="15px" alt=""></a>
              @endif
              </div>

              <div class="viewuser_email">權限：{{$user['role']}}
              @if( (($user['role'] != 'admin' and $user['role'] != 'ganaral_manager') or $user['id'] == $userid) or $role == 'admin')
              <a href="{{url('dashboard/admin/users/roles',array($user['id']))}}" class="p-icon-2" title="Change Role">
              <img src="{{asset('assets/images/dashboard/p-edit.png')}}" height="15px" width="15px" alt=""></a>
              @endif
              </div>
              
              @if($phone[$loop] != null)
              <div class="viewuser_email">連絡電話：{{$phone[$loop++]}}
              @else
              <div class="viewuser_email">未留下連絡電話{{$phone[$loop++]}}
              @endif
              </div>
              
              <div class="row-fluid viewuser_detail_2">
                <!-- Left -->
                <!--須追加使當前使用者為admin-->
                @if( (($user['role'] != 'admin' and $user['role'] != 'ganaral_manager') or $user['id'] == $userid) or $role == 'admin') 
                <div class="span6 viewuser_left">
                
                  <div class="viewuser_active">
                    <div class="viewuser_active_title">
                      <span>可使用:</span>
                      @if($user['activated'] == true)
                      <div class="view_checkbox"><input type="checkbox" id="activated-{{$user['id']}}" checked class="regular-checkbox checked" /><label userid={{$user['id']}} checked class="activated" for="activated-{{$user['id']}}"></label></div>
                      @else
                      <div class="view_checkbox"><input type="checkbox" id="activated-{{$user['id']}}" class="regular-checkbox checked" /><label userid={{$user['id']}} class="activated"  for="activated-{{$user['id']}}"></label></div>
                      @endif
                    </div>
                    <p>使用於 : {{new ExpressiveDate($user['activated_at'])}}</p>
                  </div>
                  <div class="viewuser_active">
                    @if($user['suspended'] == true)
                    <div class="viewuser_active_title">
                      <span>停權:</span>
                      <div class="view_checkbox"><input type="checkbox" id="suspended-{{$user['id']}}" checked class="regular-checkbox checked" /><label userid={{$user['id']}} checked class="suspended" for="suspended-{{$user['id']}}"></label></div>
                    </div>
                    <p>該用戶被停權 </p>
                    @else
                    <div class="viewuser_active_title">
                      <span>停權:</span>
                      <div class="view_checkbox"><input type="checkbox" id="suspended-{{$user['id']}}"  class="regular-checkbox checked" /><label userid={{$user['id']}} class="suspended" for="suspended-{{$user['id']}}"></label></div>
                    </div>
                    <p>該用戶有權 </p>
                    @endif
                  </div>
                  <div class="viewuser_active">
                    @if($user['banned'] == true)
                    <div class="viewuser_active_title">
                      <span>禁止:</span>
                      <div class="view_checkbox"><input type="checkbox" id="banned-{{$user['id']}}" checked class="regular-checkbox checked" /><label userid={{$user['id']}} checked class="banned" for="banned-{{$user['id']}}"></label></div>
                    </div>
                    <p>該用戶被禁止</p>
                    @else
                    <div class="viewuser_active_title">
                      <span>禁止:</span>
                      <div class="view_checkbox"><input type="checkbox" id="banned-{{$user['id']}}"  class="regular-checkbox checked" /><label userid={{$user['id']}} class="banned" for="banned-{{$user['id']}}"></label></div>
                    </div>
                    <p>該用戶未被禁止</p>
                    @endif
                  </div>
                  
                </div>
                @endif
                <!-- Right -->
                <div class="span6 viewuser_right">
                  <p>嘗試登入 : {{$user['loginAttempt']}}</p>
                  <p>上次登入 : {{new ExpressiveDate($user['last_login'])}}</p>
                  <p>創建於 : {{new ExpressiveDate($user['created_at'])}}</p>
                  <p>更新於 : {{new ExpressiveDate($user['updated_at'])}}</p>
                </div>
              </div>
            </div>
            <?php $i++; ?>
            <?php
            if($i==3)
            {
          echo(' </div>
        </div>');
        $i = 0;
        }
        ?>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Start Delete popup  -->
<div id="myModal-item-delete" class="modal cal_light_box hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Really ?</h3>
  </div>
  <div class="modal-body">
    <div class="confirm-delete">Confirm delete the User?</div>
    <div class="confirm-button">
      <form method="post" action="{{url('/dashboard/admin/users/delete')}}">  <input type="hidden" name="userId" id="userId" value=""  > <button class="submit">Yes please.</a></button></form>
    <button class="submit dontdelete" id="dontdelete" >No Thanks.</a></button></div>
  </div>
</div>
<!-- End Delete popup -->
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
   {{ HTML::script('assets/js/dashboard/adminusers.js') }}
  <script>
  $(function() {
    var userModel = new UserModel();
    var userView = new UserView({
      model: userModel
    });
  });
  $(document).on("click", ".user_delete", function() {
    var userid = $(this).attr('userid');
    $('#userId').val(userid);
    $('#myModal-item-delete').modal('show');
  });

  $(document).on("click", ".dontdelete", function() {

    $('#myModal-item-delete').modal('hide');
  });
  </script>
@stop

