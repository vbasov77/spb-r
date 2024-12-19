<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obj extends Model
{
    protected $table = 'objects';
    public $timestamps = false;

    protected $fillable = ['address', 'coordinates', 'count_rooms', 'floor', 'area'];
}
