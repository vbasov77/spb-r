<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materials';
    public $timestamps = false;

    protected $fillable = ['obj_id','title','description', 'price', 'quantity'];
}
