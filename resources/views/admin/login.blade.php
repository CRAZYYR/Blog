
<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>欢迎来到登录界面...</title>
        <!-- CSS -->
        <link rel='stylesheet' href="{{asset('public/assets/css/login.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">


<style type="text/css">
body{
    background-size: 100%;
    background-repeat: no-repeat;
    background-image: url("{{asset('public/assets/img/backgrounds/3.jpg')}}");
}
.bottom_login{
    margin-top:100px;
    text-align: center;
}

.login_ul li{
    width: 50px;
    height: 50px;
   float: left; 
}
</style>
    </head>

    <body>

        <div class="page-container">
            <h1>一语知心</h1>
            @if(session('msg'))
            <p style="margin-top: 10px;color: red;">{{session('msg')}}</p>
            @endif
            <form action="" method="post">

            <!-- 表单验证token值,缺一不可！,否则不无登录！ -->
              {{csrf_field()}}
                <input type="text" name="user" class="username" placeholder="账户">
                <input type="password" name="pw" class="password" placeholder="密码">
                
                <input type="text" name="img" class="img" placeholder="输入验证码">

                <img id="image" class="image" src="{{url('admin/code')}}" width="300" height="60" style="margin-top:10px;">
       
                <button type="submit">登陆</button>


                <div class="error"><span>+</span></div>
            </form>
         
        </div>
 
        <!-- Javascript -->
        <script src="{{asset('public/assets/js/jquery-3.1.1.js')}}"></script>
 
        <script src="{{asset('public/assets/js/scripts.js')}}"></script>
    
    </body>
<script type="text/javascript">
    var imgurl=($('.image').attr('src')+"?"+Math.random());
    $('#image').click(function(){
         $('.image').attr('src',imgurl);
     
    });


</script>


<p class="bottom_login"> ©<?php echo date('Y',time()); ?> <a href="www.mylzs.cn">www.mylzs.cn</a> 一语知心欢迎你!</p>

</html>

