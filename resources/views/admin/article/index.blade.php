@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="#">文章管理</a> &raquo; 全部分类
    </div>
    <!--面包屑导航 结束-->
    <div style="text-align: center; margin-top: 20px;"><h3>文章列表</h3></div>
    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
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
         
       
            <th class="tc">ID</th>
            <th class="tc">标题</th>
            <th class="tc">标记</th>
              <th class="tc">描述</th>
            <th class="tc">发布时间</th>
            <th class="tc">作者</th>
             <th class="tc">点击数</th>
            <th class="tc">操作</th>
        </tr>
        @foreach($data as $k=>$v)
            
       

        <tr>
           
   
            <td class="tc">{{$v['art_id']}}</td>
              <td class="tc"> {{ $v->art_title}}</td>
            <td class="tc">{{substr_replace($v->art_tag,'...',10)}}</td>
            <td class="tc">{{$v->art_description}}</td>
            <td class="tc">{{date('Y年m月d日',$v->art_time)}}</td>
              <td class="tc">{{$v->art_editor}}</td>
            <td class="tc">{{$v->art_view}}</td>
          
            <td >
                <a  href="{{url('admin/article/'.$v->art_id.'/edit')}}">修改</a>
                <a href="javascript:;" onclick="deleteRow(this)">删除</a>
            </td>
        </tr>
         @endforeach
  
    </table>





                <div class="page_list">
                    {!! $data->render() !!}
                </div>
            </div>
        </div>
    </form>
  
    <!--搜索结果页面 列表 结束-->
<script type="text/javascript">
var url="{{url('admin/cate/changerOrder')}}";
function changerOrder(object){
  var wid=$(object).parent().next().html();
  var xid=$(object).val();
    $.post(url,{'cate_order':xid,'cate_id':wid,'_token':'{{csrf_token()}}'},function(data){
        if (data.status) {
           layer.msg(data.msg, {icon: 6});
        }else{
          layer.msg(data.msg, {icon: 5});
        }
    },'json');
}
function deleteRow(obj){
     var id=$(obj).parent().parent().children("td:eq(0)").html();
     var row=$(obj).parent().parent();
    layer.confirm('是否删除？', {
  btn: ['确定','取消'] //按钮
}, function(){

    $.post("{{url('admin/article')}}/"+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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
<style type="text/css">
.result_content ul li span {
    font-size: 15px;
        padding: 6px 12px;
}
</style>
@endsection