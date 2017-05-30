<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class ArticleController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $data=Article::paginate(5);
//       dd($data->links());
          $data=Article::orderBy('art_time','desc')->paginate(20);
     
        return view('admin.article.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data=(new Category)->tree();
 
       return view('admin.article.add',compact('data'));
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
          
    
            $input['art_time'] = time();
            $rules=array(
                'art_content'=>'required',
                'art_title'=>'required',
                );
            $message=array(
                'art_title.required'=>'标题不能为空!',
                'art_content.required'=>'文章内容不能为空!',
                );
            $validade=Validator::make($input,$rules,$message);

   
         if ($validade->passes()) {
              $rs                = Article::create($input);
            return redirect('admin/article');
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
        $data=(new Category)->tree();
        $rs=Article::find($id);
        return view('admin.article.edit',compact('data','rs'));
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
        $input=Input::except('_method','_token');
        $input['art_time']=time();
        $rs=Article::where('art_id',$id)->update($input);
            if ($rs) {
           return redirect('admin/article');
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
       $rs=Article::where('art_id',$id)->delete();
        if (!$rs) {
        $data['status']=0;
        $data['msg']='删除失败！';
          return $data;
        }
        return $data;
    }
}
