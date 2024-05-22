<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public static function get(){
        $m = Option::first();
        return $m ?? null;
    }

    public function getlogo(){
        if(empty($this->logo)){
            return 'https://placehold.co/200x75/ffffff/000000?text=printCRM';
        }
        return $this->logo;
    }

}
