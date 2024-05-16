<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function patronage(){
        return $this->belongsTo('App\Models\Patronage');
    }
}
