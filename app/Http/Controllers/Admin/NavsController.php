<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!session('uid')){
              return redirect('admin/login');
        }
         $data=Navs::orderBy('nav_order','asc')->paginate(20);
    
        return view('admin.navs.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(!session('uid')){
              return redirect('admin/login');
        }
        return view('admin.navs.add');
    }
    public function changerOrder(){
        
               $input  =  Input::all();
        $rs = Navs::find($input['nav_id']);
        $rs->nav_order=$input['nav_order'];
        $rs=$rs->save();
     if ($rs) {
         $data=array('status'=>1,'msg'=>'导航排序成功!');

     }else{
        $data=array('status'=>0,'msg'=>'导航排序失败!');
     }
      return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $input            =  Input::except('_token');
          
  
            $rules=array(
                'nav_name'=>'required',
                'nav_url'=>'required',
                'nav_alias'=>'required',
                );
            $message=array(
                'nav_name.required'=>'导航名称不能为空!',
                'nav_url.required'=>'导航连接不能为空!',
                'nav_alias.required'=>'英文导航不能为空!',
                );
            $validade=Validator::make($input,$rules,$message);

   
         if ($validade->passes()) {
              $rs           = Navs::create($input);
            return redirect('admin/navs');
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
     $data=Navs::find($id);
        return view('admin.navs.edit',compact('data'));
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
       
       $rs=Navs::where('nav_id',$id)->update($input);
             if ($rs) {
           return redirect('admin/navs');
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
     $rs=Navs::where('nav_id',$id)->delete();
        if (!$rs) {
        $data['status']=0;
        $data['msg']='删除失败！';
          return $data;
        }
        return $data;
     
    }
}
