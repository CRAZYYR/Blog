<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{



    public function __construct(){
        
        if(!session('uid')){
              return redirect('admin/login');
        }
        //  if(isset($_SESSION['uid'])){
        //       return redirect('admin/login');
        // }
    }
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 图片上传处理
     * @return [type] [description]
     */
    public function upload(){
       $file= Input::file('Filedata');
     // $file= Input::all();

    
    if ($file->isValid()) {
         // 获取文件相关信息 
  $originalName = $file->getClientOriginalName(); 

  //临时文件的绝对路径 
  $type = $file->getClientMimeType(); 
   // 文件后缀名
  $ext = $file->getClientOriginalExtension();
  //文件的绝对路径
    $realPath = $file->getRealPath(); 
  
 //  文件的名字 uniqid()
  $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//储存路径
$path = $file -> move(base_path().'\uploads',$filename);//储存路径
    $filepath='uploads/'.$filename;
    return $filepath;
     }

  
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
