<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Routing\Controller;

class SecondController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('showString3');
    }

    public function showString1()
    {
        return'showString1';
    }
    public function showString2()
    {
        return'showString2';
    }
    public function showString3()
    {
        return'showString3';
    }
    public function showString4()
    {
        return'showString4';
    }

}
