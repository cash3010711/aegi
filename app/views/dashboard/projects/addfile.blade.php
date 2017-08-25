@extends('dashboard.default')
@section('head')
<title>92five app - Add File</title>
@stop
@section('content')
<div id="contentwrapper">
  <div class="main_content">
    <div class="row-fluid">
      <div class="span12 project_detail">
        <h2><a href="{{url('/dashboard')}}">總覽</a> / <a href="{{url('/dashboard',array($parentType.'s'))}}">{{$parentType}}</a> / 新增檔案</h2>
        <div class="row-fluid proj_create">
          <h3> {{$parentName}}  <div class="p-icon-main">
          </div></h3>
          <div class="row-fluid span12 proj_create_detail">
            <div class="row-fluid">
              <!-- Left Part -->
              <div class="span12 add-proj-form">
                <fieldset>
                  <div class="control-group">
                    <label>新增檔案:
                      <p class="help-block"></p>
                    </label>
                    @if($parentType == 'Task')
                    <form id='dropzone' action='#'class="dropzone" method="post">
                      @elseif($parentType == 'Project')
                      <form id='dropzone' action='add/files' class="dropzone" method="post">
                        @endif
                        <input type="hidden" name="project_id" id="project_id" value={{$parentId}}/>
                        <div class="fallback">
                          <input name="file" type="file" multiple />
                        </div>
                      </form>
                    </div>
                  </fieldset>
                  <div class="submit_button_main">
                    @if($parentType == 'Task')
                      <?php
                          // $task_name = $_POST["task_name"];
                          // $task_name = urlencode($task_name);
                          // $projectlist = $_POST["projectlist"];
                          // $projectlist = urlencode($projectlist);
                          // $startdate = $_POST["startdate"];
                          // $startdate = urlencode($startdate);
                          // $enddate = $_POST["enddate"];
                          // $enddate = urlencode($enddate);
                          // $note = $_POST["note"];
                          // $note = urlencode($note);
                          // $tagsinput = $_POST["tagsinput"];
                          // $tagsinput = urlencode($tagsinput);
                          // $subtasks = $_POST["subtasks"];
                          // $subtasks = urlencode($subtasks);
                      ?>  
                      <input type="hidden" name="task_name" id="task_name" value={{$task_name}} />
                      <input type="hidden" name="projectlist" id="projectlist" value={{$projectlist}}  />
                      <input type="hidden" name="startdate" id="startdate" value={{$startdate}}  />
                      <input type="hidden" name="enddate" id="enddate" value={{$enddate}}  />
                      <input type="hidden" name="note" id="note" value={{$note}}  />
                      <input type="hidden" name="tagsinput" id="tagsinput" value={{$tagsinput}}  />
                      <input type="hidden" name="subtasks" id="subtasks" value={{$subtasks}} />
                      <script>
                        function foo2 () {
                          var task_name=encodeURIComponent(document.getElementById("task_name").value);
                          var projectlist=encodeURIComponent(document.getElementById("projectlist").value);
                          var startdate=encodeURIComponent(document.getElementById("startdate").value);
                          var enddate=encodeURIComponent(document.getElementById("enddate").value);
                          var note=encodeURIComponent(document.getElementById("note").value);
                          var tagsinput=encodeURIComponent(document.getElementById("tagsinput").value);
                          var subtasks=encodeURIComponent(document.getElementById("subtasks").value);
                          window.open(`../../app/views/dashboard/send.php?task_name=${task_name}&projectlist=${projectlist}&startdate=${startdate}&enddate=${enddate}&note=${note}&tagsinput=${tagsinput}&subtasks=${subtasks}`,'',config='height=300,width=450,toolbar=no, status=no, menubar=no, resizable=no, scrollbars=no');}
                      </script>
                      <a href="{{url('/dashboard/task/added')}}" class="submit" onclick="foo2()">Done</a> 
                    <!--....................................................................................-->
                    @elseif($parentType == 'Project')
                      <?php
                          $project_name=$_POST["project_name"];
                          $project_name=urlencode($project_name);
                          $description=$_POST["description"];
                          $description=urlencode($description);
                          $project_client=$_POST["project_client"];
                          $project_client=urlencode($project_client);
                          $note=$_POST["note"];
                          $note=urlencode($note);
                          $startdate=$_POST["startdate"];
                          $startdate=urlencode($startdate);
                          $enddate=$_POST["enddate"];
                          $enddate=urlencode($enddate);
                          $tagsinput=$_POST["tagsinput"];
                          $tagsinput=urlencode($tagsinput);
                      ?>
                      <input type="hidden" name="project_name" id="project_name" value=<?php echo $project_name;?> />
                      <input type="hidden" name="description" id="description" value=<?php echo $description;?> />
                      <input type="hidden" name="project_client" id="project_client" value=<?php echo $project_client;?> />
                      <input type="hidden" name="note" id="note" value=<?php echo $note;?> />
                      <input type="hidden" name="startdate" id="startdate" value=<?php echo $startdate;?> />
                      <input type="hidden" name="enddate" id="enddate" value=<?php echo $enddate;?> />
                      <input type="hidden" name="tagsinput" id="tagsinput" value=<?php echo $tagsinput;?> />
                      <script>
                        function foo () {
                          window.open(`../../app/views/dashboard/send.php?project_name=${document.getElementById("project_name").value}&description=${document.getElementById("description").value}&
                          project_client=${document.getElementById("project_client").value}&
                          note=${document.getElementById("note").value}&
                          startdate=${document.getElementById("startdate").value}&
                          enddate=${document.getElementById("enddate").value}&
                          tagsinput=${document.getElementById("tagsinput").value}`, 
                          '',config='height=300,width=450,toolbar=no, status=no, menubar=no, resizable=no, scrollbars=no');
                        }
                      </script>
                    <a href="{{url('/dashboard/projects/add/done')}}" class="submit" onclick="foo()">上傳</a>
                    @endif
                  </div>
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
{{ HTML::style('assets/css/dashboard/dropzone.css') }}
{{ HTML::script('assets/js/dashboard/dropzone.js') }}
@stop

