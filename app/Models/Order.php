<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function status(){
        return $this->hasOne('App\Models\OrderStatus', 'id', 'order_status_id');
    }
}
