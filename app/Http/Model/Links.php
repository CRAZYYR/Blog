<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
         protected $guarded = [];
         protected $table ='links';
         protected $primaryKey='link_id';
         public $timestamps = false;
}
