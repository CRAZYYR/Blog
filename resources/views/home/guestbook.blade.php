@extends('layouts.admin')
@section('content')

 
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

         <h2><p style="text-align: center;margin-top: 50px;">Messages for shuai zi</p></h2>  
    <div class="result_wrap">

        <form action="{{url('home/sendmsg')}}" method="post">
        {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                
                  
                    <tr>
                        <th><i class="require">*</i>你的昵称：</th>
                        <td> 
                         <input type="text" class="lg" name="msg_name">                            

                            <span><i class="fa fa-exclamation-circle yellow"></i>留下昵称,方便交流！</span>
                        </td>
                    </tr>
                 <tr>
                        <th>你的图像：</th>
                        <td>
                          <input type="text" class="lg" name="msg_img" placeholder="目前只支持电脑上传图像!">
                            <input id="file_upload"  type="file" multiple="true">
                           <img style="max-width: 350px;max-height:100px;"  id="img"  src="" name="img">
                        </td>
                    </tr>

<script src="{{asset('/public/org/upload/jquery.uploadify.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('/public/org/upload/uploadify.css')}}">

               
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
                    $('input[name=msg_img]').val(data);
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
                        <th><i class="require">*</i>留言内容：</th>
                        <td>
             <script id="editor" name="msg_content" type="text/plain" style="width:860px;height:300px;"></script> 
                    <script type="text/javascript">
var ue = UE.getEditor('editor');

                    </script>
                       
        
                        </td>
                    </tr>
                  
                    <tr>
                        <th></th>
                        <td>

                            <input type="submit" value=" 留言">

                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

@endsection