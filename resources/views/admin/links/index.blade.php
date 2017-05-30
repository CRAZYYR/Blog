@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 友情链接管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap" style="text-align: center;color: #949494;">
       <h3>友情链接列表</h3>
    </div>

    <!--结果页快捷搜索框 结束-->
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>新增连接</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
    <table class="list_tab">
        <tr>
         
            <th class="tc">排序</th>
            <th class="tc">ID</th>
            <th class="tc">连接名称</th>
            <th class="tc">连接标题</th>
            <th class="tc">链接地址</th>
          
       
            <th>操作</th>
        </tr>
        @foreach($data as $k=>$v)
            
       

        <tr>
           
            <td class="tc">
               <input onchange="changerOrder(this)" type="text" name="ord[]" value="{{$v['link_order']}}">
            </td>
            <td class="tc">{{$v['link_id']}}</td>
            <td class="tc">
                {{$v['link_name']}}
            </td>
            <td class="tc">{{$v->link_title}}</td>
            <td ><a  href="{{$v->link_url}}">{{$v->link_url}}</a></td>
            
            <td>
                <a href="{{url('admin/links/'.$v->link_id.'/edit')}}">修改</a>
                <a href="javascript:;" onclick="deleteRow(this)">删除</a>
            </td>
        </tr>
         @endforeach
  
    </table>






                <div class="page_list">
                    <ul>
                       
                    {!! $data->render() !!}    
<style type="text/css">
.result_content ul li span {
    font-size: 15px;
        padding: 6px 12px;
}
</style>           
                    </ul>
                </div>
            </div>
        </div>
    </form>
  
    <!--搜索结果页面 列表 结束-->
<script type="text/javascript">
var url="{{url('admin/links/changerOrder')}}";
function changerOrder(object){
  var wid=$(object).parent().next().html();
  var xid=$(object).val();
    $.post(url,{'link_order':xid,'link_id':wid,'_token':'{{csrf_token()}}'},function(data){
        if (data.status) {
           layer.msg(data.msg, {icon: 6});
           setTimeout(function(){
                location.href = location.href;
           },2000);
         
        }else{
          layer.msg(data.msg, {icon: 5});
        }
    },'json');
}
function deleteRow(obj){
     var id=$(obj).parent().parent().children("td:eq(1)").html();
     var row=$(obj).parent().parent();
    layer.confirm('是否删除？', {
  btn: ['确定','取消'] //按钮
}, function(){

    $.post("{{url('admin/links')}}/"+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
            if (data.status) {
            row.remove();
          location.href = location.href;
         layer.msg(data.msg, {icon: 1});
            }else{
       layer.msg(data.msg, {icon: 5});   
            }
    });



 
}, function(){
 
});
}

</script>

@endsection