<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{

    protected $table = 'pay';
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
