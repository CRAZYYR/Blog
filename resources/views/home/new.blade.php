@extends('layouts.home')
@section('info')
<title>一语知心</title>

@endsection
@section('content')
<link href="{{asset('resources/views/home/public/css/new.css')}}" rel="stylesheet">
<article class="blogs">
  <h1 class="t_nav"><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$art->cate_id)}}" class="n2">{{$art->cate_name}}</a></h1>
  <div class="index_about">
    <h2 class="c_titile">{{$art->art_title}}</h2>
    <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$art->art_time)}}</span><span>编辑：{{$art->art_editor}}</span><span>查看次数：{{$art->art_view}}</span></p>
    <ul class="infos">
    {!!$art->art_content!!}
    </ul>
      <div class="keybq">
      <p><span>关键字词</span>：{{$art->art_tag}}</p>
      
      </div>
          <div class="ad"> </div>
                <div class="nextinfo">
                  <p>上一篇：
                   @if($article['pre'])
                  <a href="{{url('a/'.$article['pre']->art_id)}}">{{$article['pre']->art_title}}</a>
                  @else
                <span style="color: #949494;">亲,没有上一页了!</span>
              @endif
                  </p>
                  <p>下一篇：
              @if($article['next'])
                  <a href="{{url('a/'.$article['next']->art_id)}}">{{$article['next']->art_title}}</a>
              @else
                <span style="color: #949494;">亲,没有下一页了!</span>
              @endif
                  </p>
                </div>
              <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                @foreach($limit as $v)
                  <li><a href="{{url('a/'.$v->art_id)}}" title="{{$v->art_title}}">{{$v->art_title}}</a></li>
               @endforeach
                </ul>
              </div>
        </div>
  <aside class="right">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->
    <div class="blank"></div>
    <div class="news">
      <h3>
        <p>栏目<span>最新</span></p>
      </h3>
      @parent
    </div>
    <!-- <div class="visitors">
      <h3>
        <p>最近访客</p>
      </h3>
      <ul>
      </ul>
    </div> -->
  </aside>
</article>
@endsection