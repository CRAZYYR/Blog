<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
         protected $guarded = [];
         protected $table ='ip';
      	 protected $primaryKey='id';
    	 public $timestamps = false;
}
