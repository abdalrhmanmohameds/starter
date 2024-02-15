<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getOffer()
    {
//        return Offer::get();
        return Offer::select('id','name')->get();


    }

   /* public function store()
    {
        Offer::create([
            'name' => 'ahmed',
            'price' => '3000',
            'details' => 'offer details',
        ]);
   } */
    public function create(){
       return view('offers.create');
    }

    public function store(Request $request){

        //validate before insert to data




        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = validator::make($request->all(),$rules,$messages);

        if ($validator->fails()){
            return $validator->errors();
        }

            //insert ////////////////
            Offer::create([
               'name' => $request -> name,
                'price' => $request -> price,
                'details' => $request -> details,

            ]);
            return 'saved successfully';
    }
    protected function getMessages(){
        return  $Messages =  [
            'name.required' => 'اسم العرض مطلوب',
            'name.unique' => 'اسم العرض موجود',
            'price.required' => 'سعر العرض مطلوب',
            'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
        ];
    }

    protected function getRules(){
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',

        ];
    }
}
