<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function manager(){
        return $this->belongsTo('App\Models\Manager');
    }

    public function patronages(){
        return $this->hasMany('App\Models\ProjectPatronage');
    }

    public function uploads(){
        return $this->hasMany('App\Models\ProjectUpload');
    }

    public function messages(){
        return $this->hasMany('App\Models\ProjectMessage');
    }

    public function notes(){
        return $this->hasMany('App\Models\ProjectNote');
    }

    public function total(){
        $sum = 0;
        foreach($this->patronages as $patronage){
            $sum+=$patronage->price_per_row_with_discount_and_tax;
        }
        return $sum;
    }
}
