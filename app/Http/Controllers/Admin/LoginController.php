<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

require_once 'public/org/code/Code.class.php';
class LoginController extends CommonController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
   
   /**
    * [用户的登录处理]
    * @return [type] [description]
    */
    public function login(){


       


        // 判断是不是post方法提交过来的
        if ($input=Input::all()) {
                  $code=new \Code;
       $_code=$code->get();

           if (strtoupper($input['img'])!=$_code) {
              return back()->with('msg','验证码错误！');
           }

           $user=User::where(array('user_name'=>$input['user']))->first();

       //   $user=User::first();
            if ($user->user_name==$input['user']) {
                $pw=$this->decrypt($user->user_pw);
                if ($input['pw']!=$pw) {
               return back()->with('msg','密码错误！');     
                }else{
            session(array('uid'=>$user->user_id));
                // return redirect('admin/welcome',array('user_name'=>($user->user_name)));
                 // return view('admin.Index',array('user_name'=>$input['user']));
                 return redirect('admin/welcome');
                 
                }
            }else{
                 return back()->with('msg','账号错误！');
            }

        


        }else{
             session(['uid'=>null]);
       return view('admin.login');
        }
    }

    /**
     * 数据的加密
     * @return [String] [加密之后的数据]
     */
    public function crypt($crypt){
       
      return Crypt::encrypt($crypt);
    

    }
    /**
     * 数据的解密
     * @param  [type] $decrypt [description]
     * @return [type]          [description]
     */
    public function decrypt($decrypt){
       
      return Crypt::decrypt($decrypt);


    }

    // 设置验证码
    public function code(){
       $code=new \Code;
       echo $code->make();
    }
    // 获取验证码
    public function Getcode(){
       $code=new \Code;
       return $code->get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
