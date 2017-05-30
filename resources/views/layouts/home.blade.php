<!doctype html>
<html>
<head>
<meta charset="utf-8">
@yield('info')
<link href="{{asset('resources/views/home/public/css/base.css')}}" rel="stylesheet">
<link href="{{asset('resources/views/home/public/css/index.css')}}" rel="stylesheet">

<script src="{{asset('resources/views/home/public/js/modernizr.js')}}"></script>
<link href="{{asset('resources/views/home/public/css/style.css')}}" rel="stylesheet">
<audio src="{{url('/public/zs.mp3')}}" autoplay="autoplay" loop="-1">

</audio>
<bgsound src="{{url('/public/zs.mp3')}}" loop="-1" autostart="true"> </bgsound>
</head>
<body>
<header>
  <div id="logo"><a href="{{url('/')}}"></a></div>
  <nav class="topnav" id="topnav">
  @foreach($navs as $v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
  </nav>
  
</header>
@section('content')
 </h3>
 <style type="text/css">
#scro{
  width: 300px;
  height: 225px;
  overflow: hidden;
}

.ccc_top1{
  font-family: "微软雅黑";
  font-size:16px;
  color: #444;
  border: 1px solid #888;
  right:0px;
  bottom:50px;
  position: fixed;
  cursor: pointer;
  border-radius: 4px 4px;
  text-align: center;
  line-height:40px;
  height:40px;
  width:80px;
  opacity: 0.3;
  background-color:#fff;
}
.ccc_top1:hover{
  right:0px;
  background-color: #949494;
  color: aliceblue;
}

 </style>

<!-- 演示 -->

<div id="scro">
  <ul id="scro1" class="rank">

@foreach($new as $v)
      <li><a href="{{url('a/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
   @endforeach

</ul>
  <ul id="scro2" class="rank"></ul>

</div>
<script type="text/javascript">
var area=document.getElementById('scro');
var area1=document.getElementById('scro1');
var area2=document.getElementById('scro2');
area2.innerHTML=area1.innerHTML;
var time=50;
 function mysc(){
 if (area.scrollTop>=area1.offsetHeight) {
  area.scrollTop=0;
}else{
  area.scrollTop++;
}
}
var mycc=setInterval('mysc()',time);
area.onmouseover=function(){
  clearInterval(mycc);
}
area.onmouseout=function(){
  mycc=setInterval('mysc()',time);
}

</script>
<!--     <ul class="rank">
    @foreach($new as $v)
      <li><a href="{{url('a/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
   @endforeach
    </ul> -->
    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
    @foreach($pic as $v)
      <li><a href="{{url('a/'.$v->art_id)}}" title="{{$v->art_title}}" target="_blank">{{$v->art_title}}</a></li>
   @endforeach
    </ul>
@show


<span class="ccc_top1">
  置顶
</span>
<script type="text/javascript" src="{{asset('public/js/jquery.js')}}"></script>
<script type="text/javascript">

  $('.ccc_top1').on('click',function(){
    $('html , body').animate({
      scrollTop:0
    },800);

  });
  // $(window).on('scroll',function(){
  //   if ($(window).scrollTop()>$(window).height()) {
  //     $('.ccc_top1').fadeIn();
  //   }else{
  //     $('.ccc_top1').fadeOut();
  //   }
  // });
  // $(window).trigger('scroll');

</script>


<footer>
  <p>Design by 帅子 <a href="http://www.zscool.top/" target="_blank">http://www.mylzs.cn</a> <a href="/">​永久QQ:826573080</a></p>
</footer>

</body>
</html>
