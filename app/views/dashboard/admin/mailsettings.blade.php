@extends('dashboard.default')
@section('head')
<title>92five app - Email Settings</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard/admin')}}">系統管理員</a> / 帳號資料變更</h2>
        <div class="row-fluid proj_create">
          <form class="" action='' method='post'  data-validate="parsley" >
            <h3> 帳號資料變更
            </h3>
            <div class="row-fluid span12 proj_create_detail">
              <div class="row-fluid">
                <!-- Left Part -->
                <div class="span6 add-proj-form form-horizontal">
                  <fieldset>

                    @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))
                    <div class="control-group">
                      <label class="control-label" for="passwordinput">使用者名稱:
                      </label>
                      <div class="controls">
                        <input id="username" name="username" type="text" value="{{$data['username']}}" placeholder="使用者名稱" data-required="true" data-show-errors="true">
                      </div>
                    </div>
                    @else
                    <div class="control-group">
                      <label class="control-label" for="passwordinput">姓氏:
                      </label>
                      <div class="controls">
                        <input id="first_name" name="first_name" type="text" value="{{$data['first_name']}}" placeholder="姓氏" data-required="true" data-show-errors="true">
                      </div>
                    </div>
                    @endif
                    <div class="control-group">
                      <label class="control-label" for="passwordinput">電子信箱:</label>
                      <div class="controls">
                        <input id="host" name="host" type="text" value="{{$data['host']}}" placeholder="電子信箱" data-required="true" data-show-errors="true">
                      </div>
                    </div>
                    @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))
                    <div class="control-group">
                    <label class="control-label" for="passwordinput">阜號:</label>
                      <div class="controls">
                        <input id="port" name="port" type="text" value="{{$data['port']}}" placeholder="阜號" data-required="true" data-show-errors="true">
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label" for="passwordinput">收件名稱:</label>
                      <div class="controls">
                        <input id="serndername" name="sendername" type="text" value="{{$data['sendername']}}" placeholder="收件名稱" data-required="true" data-show-errors="true">
                      </div>
                    </div>
                    @endif
                  </fieldset>
                </div>
                <!-- Right Part -->
                <div class="span6  add-proj-form form-horizontal">
                  <fieldset>
                  @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))

                  @else
                  <div class="control-group">
                    <label class="control-label" for="passwordinput">名字:
                    </label>
                    <div class="controls">
                      <input id="last_name" name="last_name" type="text" value="{{$data['last_name']}}" placeholder="名字" data-required="true" data-show-errors="true">
                    </div>
                  </div>
                  @endif 
                    <div class="control-group">
                    <label class="control-label" for="passwordinput">密碼:</label>
                      <div class="controls">
                        <input id="password" name="password" type="text" value="{{$data['password']}}" placeholder="密碼" data-required="true" data-show-errors="true">
                      </div>
                    </div>
                  
                    <div class="control-group">
                    <label class="control-label" for="passwordinput">聯絡號碼:</label>
                      <div class="controls">
                        <input id="phone" name="phone" type="text" value="{{$data['phone']}}" placeholder="聯絡號碼" data-required="true" data-show-errors="true">
                      </div>
                    </div>

                  @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')))
                  
                    <div class="control-group">
                      <label class="control-label" for="passwordinput">收信信箱:</label>
                      <div class="controls">
                        <input id="senderaddress" name="senderaddress" type="text" value="{{$data['senderaddress']}}" placeholder="收信信箱" data-required="true" data-show-errors="true">
                      </div>
                    </div>

                    <div class="control-group">
                   
                      <label class="control-label" for="passwordinput">資料協定:
                        <p class="help-block">(optional)</p>
                      </label>
                      <div class="controls">
                    <select name="encryption" id="encryption" class="projectlist" tabindex="1"><!--選擇協定的下拉式選單-->
                      @if($data['encryption'] == '')
                      <option name="" value="null" selected="selected" title="">None</option>
                      <option name="" value="ssl" title="">SSL</option>
                      <option name="" value="tls" title="">TLS</option>
                      @elseif($data['encryption'] == 'ssl')
                      <option name="" value="null"  title="">None</option>
                      <option name="" value="ssl" selected="selected" title="">SSL</option>
                      <option name="" value="tls" title="">TLS</option>
                      @elseif($data['encryption'] == 'tls')
                      <option name="" value="null" title="">None</option>
                      <option name="" value="ssl" title="">SSL</option>
                      <option name="" value="tls" selected="selected" title="">TLS</option>
                      @endif
                    </select>
                      </div>
                    </div>
					
                    @endif
                  </fieldset>
                </div>
              </div>
              <div class="submit_button_main"><button class="submit">提交</a></button></div><!--修改中-->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- sidebar -->
</section>
@stop
@section('endjs')
{{ HTML::style('assets/css/simplelogin/parsley.css') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
@stop

