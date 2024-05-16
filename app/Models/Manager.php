<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function canTake(){
        return Project::where('manager_id', $this->id)->where('is_confirmed', true)->where('is_ordered', false)->count()==0;
    }
}
