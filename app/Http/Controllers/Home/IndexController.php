<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Config;
use App\Http\Model\Links;
use App\Http\Model\Msg;
use App\Http\Model\Ip;
use App\Http\Model\Navs;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
class IndexController extends commonController
{


  public function sendmsg(){


       $input=Input::except('_token');
       $input['msg_time']=time();
       $input['msg_ip']=$_SERVER["REMOTE_ADDR"];
      $rs= Msg::create($input);
        if(!$rs) {
            return back()->with('errors','留言失败！');
        }else{

            return redirect('home/guest');

        }

    }
       /**
     * 留言面板
     * @return [type] [description]
     */
    public function guest(){

        $data_msg=Msg::orderBy('msg_time','desc')->paginate(10);

       return view('home/guest',compact('data_msg'));
    }
    /**
     * 留言面板
     * @return [type] [description]
     */
    public function guestbook(){

       return view('home/guestbook');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      
     
        //前5图文列表
      $data=Article::orderBy('art_time','desc')->paginate(15);
 
      //友情链接
      $links=Links::orderBy('link_order','asc')->get();
      $ip=array('ip'=>$_SERVER["REMOTE_ADDR"],'time'=>time(),'number'=>0);

      $old_ip=Ip::where('ip',$_SERVER["REMOTE_ADDR"])->first();
      if (!$old_ip) {
       Ip::create($ip);
      }
       Ip::where('ip',$_SERVER["REMOTE_ADDR"])->update(['time'=>time()]);
       Ip::where('ip',$_SERVER["REMOTE_ADDR"])->increment('number');
       $totle_ip=0;
       $totles=Ip::orderBy('time','desc')->get();
       foreach ($totles as $v) {
          $totle_ip+=$v->number;
       }


        return view('home.index',compact('data','links','totle_ip'));
    }

    public function cate($id){

       $field=Category::find($id);
   $data=Article::where('cate_id',$id)->orderBy('art_time','desc')->paginate(4);
   //子分类
   $submemu=Category::where('cate_pid',$id)->get();
Category::where('cate_id',$id)->increment('cate_view');
        return view('home.list',compact('field','data','submemu'));
    }
     public function article($id){
     $art=Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$id)->first();

     $article['pre']=Article::where('art_id','<',$id)->orderBy('art_id','desc')->first();
       $article['next']=Article::where('art_id','>',$id)->orderBy('art_id','asc')->first();
        $limit=Article::where('cate_id',$art->cate_id)->orderBy('art_id','desc')->take(6)->get();
        //查看字数自增
        Article::where('art_id',$id)->increment('art_view');
        return view('home.new',compact('art','article','limit'));
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
    public function sendmail(){
       // $data = ['email'=>$email, 'name'=>$name, 'uid'=>$uid, 'activationcode'=>$code];
       //  Mail::send('activemail', $data, function($message)
       //   { $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！'); });

    }
}
