<?php

namespace App\Http\Controllers\Home;
use App\Http\Model\Article;
use App\Http\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Model\Config;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class commonController extends Controller
{
	public function __construct(){
       $hot=Article::orderBy('art_view','desc')->take(6)->get();
		 $navs=Navs::orderBy('nav_order','asc')->get();
		 $conf=Config::all();
		    //点击量最高的极品文章
      $pic=Article::orderBy('art_view','desc')->take(5)->get();

     //最新发布的文章
      $new=Article::orderBy('art_time','desc')->take(8)->get();
		View::share(['navs'=>$navs,'conf'=>$conf,'hot'=>$hot,'new'=>$new,'pic'=>$pic]);
		 
	}


	


	}