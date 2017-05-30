<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Links::orderBy('link_order','asc')->paginate(20);
    
        return view('admin.links.index',compact('data'));
    }
    /**
     * 友情排序
     * @return [type] [description]
     */
    function changerOrder(){
          $input  =  Input::all();
        $rs = Links::find($input['link_id']);
        $rs->link_order=$input['link_order'];
        $rs=$rs->save();
     if ($rs) {
         $data=array('status'=>1,'msg'=>'友情排序成功!');

     }else{
        $data=array('status'=>0,'msg'=>'友情排序失败!');
     }
      return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           return view('admin.links.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
            $input             =  Input::except('_token');
          
    
            $rules=array(
                'link_name'=>'required',
                'link_url'=>'required',
                );
            $message=array(
                'link_name.required'=>'友情名称不能为空!',
                'link_url.required'=>'友情连接不能为空!',
                );
            $validade=Validator::make($input,$rules,$message);

   
         if ($validade->passes()) {
              $rs           = Links::create($input);
            return redirect('admin/links');
          //   return back()->with('errors','发布成功!');

            }else{

               return back()->withErrors($validade);
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Links::find($id);
        return view('admin.links.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $input=Input::except('_token','_method');
       $rs=Links::where('link_id',$id)->update($input);
             if ($rs) {
           return redirect('admin/links');
        }else{
            return back()->with('errors','修改失败!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $data=array('status'=>1,'msg'=>'删除成功!');
     $rs=Links::where('link_id',$id)->delete();
        if (!$rs) {
        $data['status']=0;
        $data['msg']='删除失败！';
          return $data;
        }
        return $data;
     
    }
}
