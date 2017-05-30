@extends('layouts.home')
@section('info')
<title>一语知心</title>

@endsection
<link rel="stylesheet" type="text/css" href="{{asset('public/org/layer/skin/default/layer.css')}}">
<script type="text/javascript" src="{{asset('public/org/layer/layer.js')}}"></script>
<style type="text/css">
*{
  margin: 0px;
  padding: 0px;
}
.down_logo{
  display: none;
  position: relative;
  overflow: hidden;
}
.down_center{

  width: 900px;
  position: absolute; 
}
</style>
 <script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>

<script type="text/javascript">
$(function(){
  layer.msg('Welcome Here!');
})

</script>
<!-- guangao -->

<div id="down_logo" class="down_logo">
<div style="height:400px;width:900px;margin: 0 auto;position: relative;display: block;">
<img src="{{url('/public/img/aiqingdefushi.jpg')}}" height="400"  id="down_center" class="down_center"/>
</div>
</div>
<script type="text/javascript">
var logo=document.getElementById('down_logo');
var cent=document.getElementById('down_center');
var h=0;
var maxh=cent.height;
function down1(){
      h+=5;
    if (h<maxh) {
    logo.style.height=h + 'px';
    logo.style.display='block';
    setTimeout(down1,60);
    }else{
     logo.style.height=h + 'px';
    logo.style.display='block';
     setTimeout(up1,3000);
    }
 }
 function up1(){
  if (h>0) {
    h-=5;
    logo.style.height=h + 'px';
    logo.style.display='block';
    setTimeout(up1,60);
  }else{
    logo.style.height=0 + 'px';
    logo.style.display='none';
  }
 }
 setTimeout(down1,3000);
</script>


<!-- guanggaojieshu -->
@section('content')

<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
    
      <p style="color: red;">当我踏上这条路的时候,就注定是不归路,除非有人开枪!</p>
    </ul>
    <div class="avatar"><a href="http://www.mylzs.cn/home/guest"><span>帅子</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>帅子 推荐</span> Enjoyment</p>
    </h3>
<!-- yanshi -->
<style type="text/css">
#demo {
 background: #949494;
 overflow:hidden;
 border: 1px dashed #CCC;
 width: 1280px;
 height:100px;
 }
 #demo img {
 border: 3px solid #F2F2F2;
 }
 #indemo {
 float: left;
 width: 800%;
 }
 #demo1 {
 float: left;
 }
 #demo2 {
 float: left;
 }

</style>
<script type="text/javascript">
</script>
 <div id="demo" class="home_ad">
 <div id="indemo" class="picScroll-left">
 <div id="demo1" class="bd">
  <ul class="picList da-thumbs" id="da-thumbs">
                @foreach($hot as $v)
    @if(!$v->art_thumb)
     <li><a title="{{$v->art_title}}"  href="{{url('a/'.$v->art_id)}}"  target="_blank">

     <img width="200" height="200" src="{{url('/public/img/bak.jpg')}}" title="{{$v->art_title}}"></a><span>{{$v->art_title}}</span></li>
    @else
      <li><a title="{{$v->art_title}}" href="{{url('a/'.$v->art_id)}}"  target="_blank"><img width="300" height="300" title="{{$v->art_title}}" src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span></li>

      @endif
 @endforeach
            </ul>
 </div>
 <div id="demo2"></div>
 </div>
 </div>

<!-- drop image -->

<script>
var speed=40;
var tab=document.getElementById("demo");
var tab1=document.getElementById("demo1");
var tab2=document.getElementById("demo2");
tab2.innerHTML=tab1.innerHTML;
function Marquee(){
if(tab2.offsetWidth-tab.scrollLeft==0)
tab.scrollLeft-=tab1.offsetWidth
else{



 tab.scrollLeft++;

 }
}
var MyMar=setInterval(Marquee,speed);
tab.onmouseover=function() {clearInterval(MyMar)};
tab.onmouseout=function() {MyMar=setInterval
(Marquee,speed)};
</script>
<!-- drop image over -->


 <!--  <div class="home_ad">
    <div class="picScroll-left">
      
        <div class="bd">
            <ul class="picList da-thumbs" id="da-thumbs">
                @foreach($hot as $v)
    @if(!$v->art_thumb)
     <li><a href="{{url('a/'.$v->art_id)}}"  target="_blank"><img src="{{url('/public/img/bak.jpg')}}"></a><span>{{$v->art_title}}</span></li>
    @else
      <li><a href="{{url('a/'.$v->art_id)}}"  target="_blank"><img src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span></li>
      @endif
 @endforeach
            </ul>
        </div>
    </div>
</div> -->

<!--     <ul>

  @foreach($hot as $v)
    @if(!$v->art_thumb)
     <li><a href="{{url('a/'.$v->art_id)}}"  target="_blank"><img src="{{url('/public/img/images.jpg')}}"></a><span>{{$v->art_title}}</span></li>
    @else
      <li><a href="{{url('a/'.$v->art_id)}}"  target="_blank"><img src="{{url($v->art_thumb)}}"></a><span>{{$v->art_title}}</span></li>
      @endif
 @endforeach
    </ul> -->
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
  @foreach( $data as $v)
    <h3>{{$v->art_title}}</h3>
    <figure>

 @if(!$v->art_thumb)
     <img width="100" height="100" src="{{url('/public/img/bak.jpg')}}"></figure>
    @else
       <img width="100" height="100" src="{{url($v->art_thumb)}}"></figure>
      @endif
   
    <ul>
      <p>{{$v->art_description}}</p>
      <a title="{{url('a/'.$v->art_id)}}" href="{{url('a/'.$v->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span>{{date('Y年m月d日',$v->art_time)}}</span><span>作者：{{$v->art_editor}}</span><span>view：[<a href="/news/life/">{{$v->art_view}}</a>]</span></p>
  
   @endforeach
     <div class="page">

  <ul class="pagination">{!! $data->render() !!}</ul>


    </div>
  </div>
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe></div>
       <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <div class="news" style="float: left;">

    <h3>
      <p>最新<span>文章</span></p></h3>
   @parent
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
    @foreach($links as $v)
      <li><a href="{{url($v->link_url)}}">{{$v->link_name}}</a></li>
    @endforeach
    </ul> 
    <h3 class="links">
     <p>友情<span>提醒</span></p>
     </h3>
     <br>
     <p style="font-size: 14px;font-style: #949494; text-align: center;">亲,你是第&nbsp;<font size="5" color="#C07ABB">{{$totle_ip}}</font>&nbsp;位访问者!</p>
  
    </div>  
    <!-- Baidu Button BEGIN -->
 
    <!-- Baidu Button END -->   
    </aside>

</article>
@endsection