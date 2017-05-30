@extends('layouts.home')
@section('info')
<title>{{$field->cate_name}}|一语知心</title>

@endsection
@section('content')


<article class="blogs">
<h1 class="t_nav"><span>{{$field->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$field->cate_id)}}" class="n2">{{$field->cate_name}}</a></h1>
<div class="newblog left">

@foreach($data as $v)
   
         <h2>{{$v->art_title}}</h2>
   <p class="dateview"><span>发布时间：{{date('Y年m月d日',$v->art_time)}}</span><span>作者：{{$v->art_editor}}</span><span>分类：[<a href="{{url('cate/'.$field->cate_id)}}">{{$field->cate_name}}</a>]</span></p>
    <figure>@if(!$v->art_thumb)
     <img width="100" height="100" src="{{url('/public/img/bak.jpg')}}"></figure>
    @else
       <img width="100" height="100" src="{{url($v->art_thumb)}}"></figure>
      @endif
    </figure>
    <ul class="nlist">
      <p>{{$v->art_description}}</p>
      <a title="{{$v->art_title}}" href="{{url('a/'.$v->art_id)}}" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <div class="line"></div>
@endforeach
    <div class="blank"></div>
    <div class="ad" style="text-align: center;color: #949494;">  
  <h3> 帅子欢迎你的到来!</h3>
    </div>
    <div class="page">

<ul class="pagination">
{!! $data->render() !!}
</ul>

 
    </div>
</div>
<aside class="right">
@if($submemu)
   <div class="rnav">
      <ul>
      @foreach($submemu as $k=>$v)
       <li class="rnav{{mt_rand(1,4)}}"><a href="{{url('cate/'.$v->cate_id)}}" target="_blank">{{$v->cate_name}}</a>
       </li>
       @endforeach
     
     </ul>      
    </div>
    @endif
<div class="news">
<h3>
 <p>最新<span>文章</span></p></h3>
  @parent
    </div>
  <!--   <div class="visitors">
      <h3><p>最近访客</p></h3>
      <ul>

      </ul>
    </div> -->
     <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
</aside>
</article>
@endsection