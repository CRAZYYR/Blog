<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categorys=Category::all();
        // $data=$this->getTree($categorys);
        $data=(new Category)->tree();
        $rs=User::find(session('uid'));
       return view('admin.category.list',compact('rs','data'));
    }
    /**
     * 异步处理排序问题
     * @return [type] [description]
     */
    function changerOrder(){
        $input  =  Input::all();
        $rs = Category::find($input['cate_id']);
        $rs->cate_order=$input['cate_order'];
        $rs=$rs->save();
     if ($rs) {
         $data=array('status'=>1,'msg'=>'分类更新成功!');
     }else{
        $data=array('status'=>0,'msg'=>'分类更新失败!');
     }
      return $data;
    }
    /**
     * 添加分类.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Category::where('cate_pid',0)->get();

       return view('admin.category.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *添加分类提交
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=Input::except('_token');
       //  if(!$input['cate_pid']){
       // return back()->with('cate_option','请选择文章分类！');
       //  }
       
         $rules=array(
                'cate_name'=>'required',
                );
            $message=array(
                'cate_name.required'=>'分类名称不能为空!',
                );
            $validade=Validator::make($input,$rules,$message);
            if ($validade->passes()) {
              Category::create($input);
             return back()->with('errors','增加成功！');

            }else{

               // dd($validade->errors()->all());
               return back()->withErrors($validade);
            }



    }

    /**
     * 显示单个分类.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑分类
     * Show the form for editing the specified resource.
    
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat_edit=Category::find($id);
        $data= Category::where('cate_pid',0)->get();
      return view('admin.category.edit',compact('cat_edit','data'));
    }

    /**
     * 更新分类
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input  =  Input::except('_token','_method');
        
        $rs=Category::where('cate_id',$id)->update($input);
        if ($rs) {
           return redirect('admin/category');
        }else{
            return back()->with('errors','修改失败!');
        }
    }

    /**
     * 删除扥累
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $rs=Category::where(array('cate_id'=>$id))->select();
        // echo $rs['cate_pid'];
        // if (!$rs['cate_pid']) {
         
        // }
  $data=array('status'=>1,'msg'=>'删除成功!');
     $rs=Category::where('cate_id',$id)->delete();
        if (!$rs) {
        $data['status']=0;
        $data['msg']='删除失败！';
          return $data;
        }
        Category::where(array('cate_pid'=>$id))->update(['cate_pid'=>0]);
        return $data;
     
     }
}
