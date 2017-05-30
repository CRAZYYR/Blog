@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap" style="text-align: center;color: #949494;">
       <h3>配置列表</h3>
    </div>

    <!--结果页快捷搜索框 结束-->
    <!--搜索结果页面 列表 开始-->

        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
            <form method="post" action="{{url('admin/config/changeContent')}}">
            {{csrf_field()}}
    <table class="list_tab">
        <tr>
         
            <th class="tc">排序</th>
            <th class="tc">ID</th>
            <th class="tc">配置名称</th>
            <th class="tc">配置标题</th>
            <th class="tc">配置内容</th>
            <th class="tc">配置说明</th>
          
       
            <th>操作</th>
        </tr>

               @if(count($errors)>0)
                   @if(is_object($errors))
                       @foreach($errors->all() as $k => $error)
                      <script type="text/javascript">
                   
                  layer.msg('{{$error}}', function(){
                    //关闭后的操作
                    });
                        </script>
                        @endforeach
                    @else
                    <script type="text/javascript">
                   layer.msg('{{$errors}}', {icon: 6});
                   </script>
                   @endif
               
             @endif
        @foreach($data as $k=>$v)
            
       

        <tr>
           
            <td class="tc">
               <input onchange="changerOrder(this)" type="text"  value="{{$v['conf_order']}}">
            </td>
            <td class="tc">{{$v['conf_id']}}</td>
            <td class="tc">
                {{$v['conf_name']}}
            </td>
            <td class="tc">{{$v->conf_title}}</td>
            <td >
            <input type="hidden" name="conf_id[]" value="{{$v['conf_id']}}">
            {!!$v->_html!!}</td>
            <td class="tc">{{$v->conf_tips}}</td>
            
            <td>
                <a href="{{url('admin/config/'.$v->conf_id.'/edit')}}">修改</a>
                <a href="javascript:;" onclick="deleteRow(this)">删除</a>
            </td>
        </tr>
         @endforeach
        
    </table>




                <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
</form>
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

  
    <!--搜索结果页面 列表 结束-->
<script type="text/javascript">
var url="{{url('admin/config/changerOrder')}}";
function changerOrder(object){
  var wid=$(object).parent().next().html();
  var xid=$(object).val();
    $.post(url,{'conf_order':xid,'conf_id':wid,'_token':'{{csrf_token()}}'},function(data){
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

    $.post("{{url('admin/config')}}/"+id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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