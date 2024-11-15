<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $table = 'archive';
    public $timestamps = false;

    protected $fillable = ['user_id', 'date_in', 'date_out', 'user_info', 'total',
        'comment'];
}
