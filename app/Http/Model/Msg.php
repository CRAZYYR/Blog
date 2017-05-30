<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
     	 protected $guarded = [];
          protected $table ='msg';
     	  protected $primaryKey='msg_id';
    	  public $timestamps = false;
}
