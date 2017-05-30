<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $guarded = [];
         protected $table ='category';
       protected $primaryKey='cate_id';
    	  public $timestamps = false;

    	 public  function tree(){
            // $categorys= Category::all();
   	 	 $categorys=$this->orderBy('cate_order','asc')->get();
       	return $this->getTree($categorys);
         //    return (new Category)->getTree($categorys);
    	 }

    public function getTree($data){
        $arr=array();
      foreach ($data as $k => $v) {

       /* =============如果是第一级标题==============*/
            if ($v->cate_pid==0) {
             $v['_catename']=$v['cate_name'];
                $arr[]=$data[$k];
            }
            foreach ($data as $key => $value) {
                if ($value->cate_pid==$v->cate_id) {
                    $value['_catename']='▷'.$value['cate_name'];
                    $arr[]=$data[$key];
                }
            }
      }
        return $arr;
    }





}
