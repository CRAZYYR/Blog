@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/navs')}}">导航管理</a> &raquo; 添加导航
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增导航</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
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

           
    <div class="result_wrap">
        <form action="{{url('admin/navs')}}" method="post">
        {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                 
                    <tr>
                        <th><i class="require">*</i>导航名称：</th>
                        <td>
                        <input type="text" name="nav_name">
                          
                          
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>英文导航：</th>
                        <td> 
                         <input type="text"  name="nav_alias">                            
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>导航链接：</th>
                        <td>
                            <input placeholder="http:://www.zscool.top" type="text" class="lg" name="nav_url">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>
                    </tr>
                       <tr>
                        <th>导航排序：</th>
                        <td>
                            <input value="0" type="text" class="lg" name="nav_order">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
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

@endsection