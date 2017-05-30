<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/admin/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/admin/style/js/ch-ui.admin.js')}}"></script>
      <script type="text/javascript" src="{{asset('public/org/layer/layer.js')}}"></script>
<style type="text/css">
.pw_error{
	height: 50px;
	width: 100%;
	background-color:#949494;
	color: #FFCC99;
	line-height: 50px;
	padding-left: 20px;
}
.bottom_index{
	text-align: center;
}

</style>
</head>
<body>


@yield('content')
</body>
		<div class="bottom_index">©{{date('Y',time())}} ●一语知心● <a href="http://www.mylzs.cn">www.mylzs.cn</a> 本著作归帅子所有,盗版必究!</div>
</html>