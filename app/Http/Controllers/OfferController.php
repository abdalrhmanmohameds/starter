<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;
   public function create(){
       return view('ajax-offers.create');
   }

   public function store(Request $request){
       //$file_name = $this->saveImages($request->photo, 'images/offers');

       //move photo

       //insert ////////////////
       Offer::create([
          // 'photo' => $file_name,
           'name_ar' => $request->name_ar,
           'name_en' => $request->name_en,
           'price' => $request->price,
           'details_ar' => $request->details_ar,
           'details_en' => $request->details_en,

       ]);
   }
}


