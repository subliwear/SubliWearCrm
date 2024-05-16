<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discount;

class Customer extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function discount(){
        if(Discount::where('customer_id', $this->id)->exists()){
            $discount = Discount::where('customer_id', $this->id)->first();
            return $discount->discount/100;
        }
        return 1;
    }
}
