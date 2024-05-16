<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPatronage extends Model
{
    use HasFactory;

    public function patronage(){
        return $this->belongsTo('App\Models\Patronage');
    }
}
