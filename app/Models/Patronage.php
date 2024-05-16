<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discount;

class Patronage extends Model
{
    use HasFactory;

    public function discount(){
        if(Discount::where('patronage_id', $this->id)->exists()){
            $discount = Discount::where('patronage_id', $this->id)->first();
            return $discount->discount/100;
        }
        return 1;
    }
}
