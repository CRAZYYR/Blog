

@extends('layouts.home')
@section('info')
<title>Message for shuai zi</title>

@endsection
	@section('content')


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
<p style="text-align: center;line-height: 50px; font-size: 50px;">客户留言内容</p>
<p style=" text-align: center; line-height: 25px; font-size: 25px; margin-top: 10px; "><a href="{{url('home/guestbook')}}" style="background-color: #949494;border-radius: 6px 6px 0px 0px; ">我要留言</a></p>
<hr/>
<style type="text/css">
*{margin: 0px;padding: 0px;}

.index_msg{
	border-left:1 solide;
	font-size: 20px;
	margin-left: 10px;

	
}
.index_msg div{
	margin-top:5px;
}
.msg{
	
	
	margin-left: 20px;

}
.book_time{
	margin-top:10px;

	width: 300px;
	height:30px;
	line-height:30px;
	
}
.nininini{
	height: 50px;
	line-height: 50px;
}
.conter_book{
margin:0px auto;
	text-align: center;
	width: 300px;
	height: 50px;
	line-height: 50px;
}
</style>
	@foreach($data_msg as $v)
<div class="index_msg">

  <div class="nininini"><p>

  <img align="left" src="
  @if($v->msg_img)
  {{url($v->msg_img)}}
  @else
  {{url('/public/img/ico/'.mt_rand(1,12).'.gif')}}
	@endif" width="50" height="50" title="{{$v->msg_name}}的留言" style="border-radius: 50px;" / >&nbsp;{{$v->msg_name}}</p></div> 

    <div><div class="conter_book">留言内容:</div><div class="msg">{!!$v->msg_content !!}</div></div> 
<?php date_default_timezone_set('PRC');?>
  <div class="book_time">留言时间:{{date('Y-m-d H:i:s',$v->msg_time)}}</div> 
	
</div><hr/>
	@endforeach



  <div class="page">

  <ul class="pagination">{!! $data_msg->render() !!}</ul>

 
    </div>



@endsection

</body>
</html>