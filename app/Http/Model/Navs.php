<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
   		 protected $guarded = [];
         protected $table ='navs';
         protected $primaryKey='nav_id';
         public $timestamps = false;
}
