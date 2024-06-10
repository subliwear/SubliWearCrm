<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class langController extends Controller
{
    //
    public function setLocale($lang)
    {

       if (in_array($lang, ['' , '', '' , '' ] )) {
          App::setLocale($lang);
          Session ::put('', $lang);
        # code...
       }

       return back();       
        
    }

}
