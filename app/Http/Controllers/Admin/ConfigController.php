<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
        $data=Config::orderBy('conf_order','asc')->paginate(20);
        foreach ($data as $k => $v) {
            switch ($v->field_type) {
                case 'input':
                $data[$k]->_html='<input name="conf_content[]" class="lg" type="text" value="'.$v->conf_content.'"></input>';
                    break;
                case 'textarea':
                    $data[$k]->_html='<textarea name="conf_content[]" class="lg" >'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                $arr=explode(',',trim($v->field_value));
                $str='';
                foreach ($arr as $key => $value) {
                    $r=explode('|',$value);
                    $c='';
                    if (trim($v->conf_content)==$r[0]) {
                       $c.='checked';
                    }
                 $str.='<input '.$c.'  value="'.$r[0].'" name="conf_content[]" type="radio" >'.$r[1];
              
                   }
                  $data[$k]->_html=$str;
                    break;
             
            }
        }

        return view('admin.config.index',compact('data'));
    }
    public function changerOrder(){
          $input  =  Input::all();
        $rs = Config::find($input['conf_id']);
        $rs->conf_order=$input['conf_order'];
        $rs=$rs->save();
     if ($rs) {
         $data=array('status'=>1,'msg'=>'配置管理排序成功!');

     }else{
        $data=array('status'=>0,'msg'=>'配置管理排序失败!');
     }
      return $data;
    }

    public function putconfig(){
        $config=Config::pluck('conf_name','conf_content');

        dd('$config');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.config.add');
    }


    public function changeContent(){
        $input=Input::all();
       foreach ($input['conf_id'] as $k => $v) {
             $rs=Config::where('conf_id',$v)->update(['conf_content'=>trim($input['conf_content'][$k])]);
             if ($rs) {
                return back()->with('errors','更新成功!');
             }

       }
       return redirect('admin/config');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=Input::all();

            $input             =  Input::except('_token');
          
    
            $rules=array(
                'conf_name'=>'required',
                'conf_title'=>'required',
                );
            $message=array(
                'conf_name.required'=>'配置名称不能为空!',
                'conf_title.required'=>'配置标题不能为空!',
                );
            $validade=Validator::make($input,$rules,$message);
   
         if ($validade->passes()) {
              $rs           = Config::create($input);
            return redirect('admin/config');
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
        $data=Config::find($id);
        return view('admin.config.edit',compact('data'));
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
       $rs=Config::where('conf_id',$id)->update($input);
             if ($rs) {
           return redirect('admin/config');
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
         $rs=Config::where('conf_id',$id)->delete();
        if (!$rs) {
        $data['status']=0;
        $data['msg']='删除失败！';
          return $data;
        }
        return $data;
    }
 
}
