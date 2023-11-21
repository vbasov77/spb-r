<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    public $timestamps = false;

    protected $fillable = ['user_id', 'date_book', 'no_in', 'no_out', 'info_book',
        'user_info', 'confirmed'];

    public function pay()
    {
        return $this->hasOne(Pay::class);
    }


}
