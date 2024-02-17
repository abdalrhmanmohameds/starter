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
//            return $validator->errors();
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

            //insert ////////////////
            Offer::create([
               'name' => $request -> name,
                'price' => $request -> price,
                'details' => $request -> details,

            ]);
//          return 'save successfully';
            return redirect()->back()->with(['success' => __('messages.success')]);
    }
    protected function getMessages(){
        return  $Messages =  [
            'name.required' => __('messages.name required'),
            'name.unique' => __('messages.name unique'),
            'price.required' => __('messages.price required'),
            'price.numeric' => __('messages.price numeric'),
            'details.required' => __('messages.details required'),
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
