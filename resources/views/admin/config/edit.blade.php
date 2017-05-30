@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/config')}}">配置管理界面</a> &raquo; 添加配置
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>新增配置</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
             @if(session('errors'))
             
                    <script type="text/javascript">
                   layer.msg('{{session('errors')}}', {icon: 5});
                   </script>
               
               
             @endif

          
    <div class="result_wrap">
        <form action="{{url('admin/config/'.$data->conf_id.'')}}" method="post">

        <input type="hidden" name="_method" value="put">
        {{csrf_field()}}
            <table class="add_tab">
                <tbody>
         
                   
                    <tr>
                        <th><i class="require">*</i>配置名称：</th>
                        <td>
                        <input value="{{$data->conf_name}}" type="text" name="conf_name">
                          
                          
                        </td>
                
                  
                    <tr>
                        <th><i class="require">*</i>配置标题：</th>
                        <td> 
                         <input value="{{$data->conf_title}}" type="text" name="conf_title">                            
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                       </tr>

                       <tr>
                        <th>配置排序：</th>
                        <td>
                            <input value="{{$data->conf_order}}"text"name="conf_order">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>
                    </tr>
                  

                 <tr>
                        <th>配置类型：</th>
                        <td> 

                 <input type="radio" @if($data->field_type=='input')checked="checked" @endif name="field_type" value="input" onclick="showT()"> input
                 <input type="radio" @if($data->field_type=='textarea')checked="checked" @endif  name="field_type" value="textarea" onclick="showT()"> textarea
                 <input type="radio" @if($data->field_type=='radio')checked="checked" @endif  name="field_type" value="radio" onclick="showT()"> radio                      
                
                        </td>
                    </tr>
                       <tr class="field_value"> 
                        <th>类型值：</th>
                        <td> 
                         <input value="{{$data->field_value}}" type="text" class="lg" name="field_value">                            
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里只有在类型为Radio时候才填写(1|开启,0|关闭)!</span>
                        </td>
                    </tr>

                      <tr>
                        <th>配置说明：</th>
                        <td>
                           <textarea name="conf_tips">{{$data->conf_tips}}</textarea>
                         
                        </td>
                    </tr>

                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
<script type="text/javascript">
showT();
function showT(){
   var v=$('input[name=field_type]:checked').val();
   if(v=='radio'){
    $('.field_value').show();
   }else{
     $('.field_value').hide();
   }
}

</script>
@endsection