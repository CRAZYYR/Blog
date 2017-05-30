@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; <a href="{{url('admin/article')}}">文章管理</a> &raquo; 添加文章
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
              
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
        <form action="{{url('admin/article/'.$rs->art_id.'')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>分类：</th>
                        <td>
                            <select name="cate_id">
                              
                                @foreach($data as $v)
                                    @if($v->cate_id==$rs->cate_id)
                                        <option selected="selected" value="{{$v->cate_id}}">{{$v->_catename}}</option>
                                    @else
                                     <option value="{{$v->cate_id}}">{{$v->_catename}}</option>
                                    @endif
                                
                                @endforeach
                            </select>
                        </td>
                    </tr>
                  
                    <tr>
                        <th><i class="require">*</i>文章标题：</th>
                        <td> 
                         <input value="{{$rs->art_title}}" type="text" class="lg" name="art_title">                            
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th>文章描述：</th>
                        <td> 
                         <input value="{{$rs->art_description}}" type="text" class="lg" name="art_description">                            
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="require">*</i>关键字：</th>
                        <td>
                            <input value="{{$rs->art_tag}}" type="text" class="sm" name="art_tag">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>

                    </tr>
                       <tr>
                        <th>编辑：</th>
                        <td>
                            <input value="{{$rs->art_editor}}" type="text" class="sm" name="art_editor">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>

                    </tr>
<script src="{{asset('/public/org/upload/jquery.uploadify.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/public/org/upload/uploadify.css')}}">

                      <tr>
                        <th>缩略图：</th>
                        <td>
                          <input value="{{$rs->art_thumb}}" type="text" class="lg" name="art_thumb">
                            <input id="file_upload"  type="file" multiple="true">
                         
                           <img style="max-width: 350px;max-height:100px;"  id="img"  src="@if($rs->art_thumb)/{{$rs->art_thumb}}@endif" name="img">
                          

                        </td>
                    </tr>
<style type="text/css">
.uploadify-button {
        background-color:#fff;
        border: none;
        padding: 0;
    }
.uploadify:hover .uploadify-button {
        background-color: transparent;
    }
</style>
    <script type="text/javascript">
          /*======时间戳的设置======*/
        <?php $timestamp = time();?>
      
       var swf ="{{asset('/public/org/upload/uploadify.swf')}}";
       var swf_php ="{{url('admin/upload')}}";
        $(function() {
            $('#file_upload').uploadify({
               
               'buttonText' : '上传图片',
                 'width'        :120,
                  'height'        :30,
                'formData'     : {
                   'timestamp' : '<?php echo $timestamp;?>',
                  '_token'     : '{{csrf_token()}}'
                },
                'swf'      : swf,
                'uploader' :swf_php,
                /*=====================当上传时候的动作======================*/
                'onUploadSuccess' : function(file, data, response) {
                    layer.msg(file.name + '上传成功! ');
                    $('input[name=art_thumb]').val(data);
                   $('#img').attr('src','/'+data);
                    setTimeout(function(){
                        $('#img').fadeOut();
                    },2000);
            
        }
            });


        });
    </script>
          <!-- 编译器的加载  -->
    <script type="text/javascript" charset="utf-8" src="{{asset('/public/org/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('/public/org/ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('/public/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
       <style>
    .edui-default{line-height: 28px;}
    div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
    {overflow: hidden; height:20px;}
    div.edui-box{overflow: hidden; height:22px;}
    </style>
                      <tr>
                        <th>文章内容：</th>
                        <td>
             <script id="editor" name="art_content" type="text/plain" style="width:860px;height:300px;">{!!$rs->art_content!!}</script> 
                    <script type="text/javascript">
var ue = UE.getEditor('editor');

                    </script>
                       
        
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