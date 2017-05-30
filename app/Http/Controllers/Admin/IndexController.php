<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;
require_once 'public/org/CCP_REST_DEMO/SDK/CCPRestSDK.php';
class IndexController extends CommonController
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
        $pdo=DB::connection()->getPdo();
        dd($pdo);
        echo config('database.default');
        echo('arg1');
    }
    /**
     * 更改密码
     * @return [type] [description]
     */
    public function pass(){

        if(!session('uid')){
              return redirect('admin/login');
        }
        //密码修改的设置
        if ($input=Input::all()) {
            $rules=array(
                'password'=>'required|between:5,20|confirmed',
                );
            $message=array(
                'password.required'=>'新密码不能为空!',
                 'password.between'=>'新密码必须在5到20位之间!',
                  'password.confirmed'=>'密码不一致!',
                );
            $validade=Validator::make($input,$rules,$message);
            if ($validade->passes()) {
               $user=User::where(['user_id'=>session('uid')])->first();

              if((Crypt::decrypt($user->user_pw)!=$input['password_o'])){
              
                return back()->with('msg','原密码错误!');
              }else{
                $user->user_pw=Crypt::encrypt($input['password']);
                $user->save();
                return back()->with('msg','密码改修成功!');
             
              };

            }else{

               // dd($validade->errors()->all());
               return back()->withErrors($validade);
            }



        }else{
     return view('admin.pass');
     }
    }
    /**
     * 退出页面到登陆页面
     * @return [type] [description]
     */
    public function quit(){
        session_destroy();

        return  redirect('admin/login');
    }
    /**
     * 后台管理欢迎界面
     * @return [type] [description]
     */
    public function  welcome(){

        if(!session('uid')){
              return redirect('admin/login');
        }
     $data=User::find(session('uid'));
        return view('admin.Index',compact('data'));
    }
    public function element(){

        if(!session('uid')){
              return redirect('admin/login');
        }
        return view('admin.element');
    }
    public function tab(){

        if(!session('uid')){
              return redirect('admin/login');
        }
        return view('admin.tab');
    }
    public function img(){

        if(!session('uid')){
              return redirect('admin/login');
        }
          return view('admin.img');
    }

    public function info(){
              
        if(!session('uid')){
              return redirect('admin/login');
        }
        return view('admin.info');
    }
   public function addpage(){
        return view('admin.add');
    }
    public function lister(){
   return view('admin.list');
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
/*=====================短信接收验证============================*/
 public function test(){
        $to='18329793492';
        $num=mt_rand(1000,9999);
        $datas=array($num);
        $this->sendTemplateSMS($to,$datas,1);
 }
 function sendTemplateSMS($to,$datas,$tempId)

 {  
  $accountSid='8a216da85bad7876015bb40feb0402ec'; 
 $accountToken='e5024b29e1914ccbaadc58b2bc7e0f3c'; 
 $appId='8a216da85bad7876015bb40feb7802f1'; 
 $serverIP='app.cloopen.com'; 
 $serverPort='8883'; 
 $softVersion='2013-12-26'; 
     $rest = new \REST($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken); 
     $rest->setAppId($appId);  
     // 发送模板短信
     echo "Sending TemplateSMS to $to ";

     $result = $rest->sendTemplateSMS($to,$datas,$tempId); 
     if($result == NULL ) {
         echo "result error!";
         return;
      }
         if($result->statusCode!=0) {
             echo "模板短信发送失败!";

             echo "error code :" . $result->statusCode . "";

             echo "error msg :" . $result->statusMsg . "";

             //下面可以自己添加错误处理逻辑
         }else{
             echo "模板短信发送成功!";

             // 获取返回信息
             $smsmessage = $result->TemplateSMS; 
             echo "dateCreated:".$smsmessage->dateCreated."";

             echo "smsMessageSid:".$smsmessage->smsMessageSid."";
         }
 }    
  
}
