<a href="javascript:void(0)" class="sidebar_switch" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">
  <div class="antiScroll">
    <div class="antiscroll-inner">
      <div class="antiscroll-content">
        <div class="sidebar_inner">
          <div class="login_info">
            <div class="user_info_data"> 
              <br>
              <h4>Hey~ {{Sentry::getUser()->first_name}} {{Sentry::getUser()->last_name}}！</h4>
            <span><center>{{ App::make('date')}}</center></span> </div>
          </div>
          <div id="side_accordion" class="accordion">
            <div class="accordion-group none_accrodion">
              <div class="accordion-heading"> <a href="{{url('/dashboard')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/dashboard.png')}}" alt=""></span>總覽 </a> </div>
            </div>
            
            <div class="accordion-group none_accrodion">
              <div class="accordion-heading"> <a href="{{url('/dashboard/projects')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/projects.png')}}" alt=""></span>計畫 </a> </div>
            </div>
            <div class="accordion-group none_accrodion">
              <div class="accordion-heading"> <a href="{{url('/dashboard/tasks')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/task.png')}}" alt=""></span>任務 </a> </div>
            </div>
            <div class="accordion-group none_accrodion">
              <div class="accordion-heading"> <a href="{{url('/dashboard/calendar')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/calendar.png')}}" alt=""></span>行事曆 </a> </div>
            </div>
            <div class="accordion-group none_accrodion">
              <div class="accordion-heading"> <a href="{{url('/dashboard/timesheet')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/timesheet.png')}}" alt=""></span>時程表 </a> </div>
            </div>
            <div class="accordion-group bdr_none1">
              <div class="accordion-heading none_accrodion"> <a href="{{url('/dashboard/mytodos')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/notes.png')}}" alt=""></span>待辦事項 </a> </div>
            </div>
          </div>
          <div id="side_accordion" class="accordion">
            @if(Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('admin')) or Sentry::getUser()->inGroup(Sentry::getGroupProvider()->findByName('ganaral_manager')))
            <div class="accordion-group bdr_none1">
              <div class="accordion-heading none_accrodion"> <a href="{{url('/dashboard/admin')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/users.png')}}" alt=""></span>系統管理員 </a> </div>
            </div>
            @else
            <div class="accordion-group bdr_none1">
              <div class="accordion-heading none_accrodion"> <a href="{{url('/dashboard/settings')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/users.png')}}" alt=""></span>帳號資料變更 </a> </div>
            </div>
            @endif
            <div class="accordion-group bdr_none1">
              <div class="accordion-heading none_accrodion"> <a href="{{url('/dashboard/roles')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/roles.png')}}" alt=""></span>權限 </a> </div>
            </div>
            <div class="accordion-group bdr_none1">
              <div class="accordion-heading none_accrodion"> <a href="{{url('/dashboard/reports')}}"> <span class="accrod_icon"><img src="{{asset('assets/images/dashboard/reports.png')}}" alt=""></span>報表 </a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>