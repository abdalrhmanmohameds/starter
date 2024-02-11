<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showAdaminName()
    {
        return'abdlarhman mohemd';
    }
    public function getIndex(){

//            $date=[];
//            $data['id'] = 5;
//            $data['name']= 'abdalrhman mohmed';
//            $data['gender']= 'male';
//            $obj = new \stdClass();
//            $obj->id = 6;
//            $obj->name = 'hamada mohemd';
//            $obj->gender = 'male';
//            return view('welcome',$data,compact('obj'));
//        return view('welcome')->with('name','omar');
//        $data= [];
        $data=['abdalrhman','mohmed'];
        return view('welcome',compact('data'));

    }
}
