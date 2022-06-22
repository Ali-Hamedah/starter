<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;



class UserController extends Controller
{
    public function ShowUserName(){
        return 'ali hamedah';
    }

public function getIndex(){

    $date = ['ali', 'ahmed'];

    return view('welcome',compact('date'));
}

}
