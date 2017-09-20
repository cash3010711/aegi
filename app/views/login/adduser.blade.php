<!DOCTYPE html>
<html>
<head>
<title>92five app - Add User With Details</title>
{{ HTML::style('assets/css/bootstrap/bootstrap.css') }}
{{ HTML::style('assets/css/bootstrap/bootstrap-responsive.css') }}
{{ HTML::style('assets/css/simplelogin/style.css') }}
{{ HTML::style('assets/css/simplelogin/custom.css') }}
{{ HTML::style('assets/css/simplelogin/parsley.css') }}      
{{ HTML::script('assets/js/jquery/jquery-1.9.1.min.js') }}
{{ HTML::script('assets/js/bootstrap/bootstrap.min.js') }}
{{ HTML::script('assets/js/simplelogin/parsley.js') }}
</head>
<body>
<?php $count=0?>
@foreach($alluser as $user)
<input type="hidden" id="alluser_email[<?php echo $count++;?>]" name="alluser_email" value={{$user}}>
@endforeach
<input type="hidden" id="max_count" name="max_count" value=<?php echo --$count?>>
    <div class="login_detail">
    <div class="error_detail_1"><img src="{{asset('assets/images/errorpages/logo12.png')}}" alt=""/></div>
    <h2>申請帳號</h2>
    <form form method="post" id="newpassform" name="newpassform" action="auth/adduser"  data-validate="parsley" onSubmit="return check()">
        
        <div class="login_form">
            <div class="row-fluid">
        <h3>
            <div class="span6"><input type="text" id="first_name" name="first_name" class="span12" placeholder="姓" data-required="true"  data-show-errors="false"></div>
            <div class="span6"><input type="text" id="last_name" name="last_name" class="span12" placeholder="名" data-required="true"  data-show-errors="false"></div>
        </h3>
                <input type="email" id="email" name="email" class="span12" placeholder="電子信箱" data-required="true"  data-show-errors="true">
                <input type="password" id="password" name="password" class="span12" placeholder="密碼(至少9碼)" data-minlength="9">
                <input type="password" id="confirmpass" name="confirmpass" class="span12" placeholder="確認密碼(至少9碼)" data-minlength="9">
                <input type="text" id="phone" name="phone" class="span12" placeholder="連絡電話">
            </div>
        </div>
        <!-- <div>
            <center>
                <select name="role" class="global_select" id="role" tabindex="1">
                    <option  name="" value="user" title=""><B>user</B></option>
                    <option  name="" value="leader" title=""><B>leader</B></option>
                    <option  name="" value="manager" title="" ><B>manager</B></option>
                </select>
            </center>
        </div> -->
            <center>
                <button class="sign_in_button">送出</button>
            </center>
    </form>
    <center>
        <button class="sign_in_button" onclick="history.back()">取消</button>
    </center>
    </div>
    </div>
</body>
</html>

<script>
function check (){
    var password = document.getElementById("password").value;
    var confirmpass = document.getElementById("confirmpass").value;
    var email = document.getElementById("email").value;
    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var max_loop = document.getElementById("max_count").value;
    //max_loop = (int)max_loop;
    var flag = 0;//0代表過
    for(var loop=0;loop<=parseInt(max_loop);loop++){
        var pass_email =document.getElementById("alluser_email["+loop+"]").value;
        if(password == confirmpass && password != "" && email != pass_email && first_name != "" && last_name != ""){
            //alert("申請成功，請等候管理者審核");
        }else{
            //alert("申請失敗");
            flag++;
        }
    }
    if(flag == 0){
        alert("申請成功，請等候管理者審核");
    }else{
        if(flag == 1){
            alert("該帳號已經有人申請");
        }else{
            alert("申請失敗");
        }
    }
}
</script>