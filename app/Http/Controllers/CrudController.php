<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

//    public function getOffer()
//    {
////        return Offer::get();
//        $offers = Offer::select('id', 'price', 'name', 'details')->get();
//        return view('offers.all');
//
//    }

    /* public function store()
     {
         Offer::create([
             'name' => 'ahmed',
             'price' => '3000',
             'details' => 'offer details',
         ]);
    } */
    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {

        //validate before insert to data


//        $rules = $this->getRules();
//        $messages = $this->getMessages();
//        $validator = validator::make($request->all(),$rules,$messages);
//
//        if ($validator->fails()){
////            return $validator->errors();
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
        //////////////////////////////////////////////////////////////////////////////////////////////
//              save photo

        $file_name = $this->saveImages($request->photo, 'images/offers');

        //move photo

        //insert ////////////////
        Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,

        ]);
//          return 'save successfully';
        return redirect()->back()->with(['success' => __('messages.success')]);
    }
//    protected function getMessages(){
//        return  $Messages =  [
//            'name.required' => __('messages.name required'),
//            'name.unique' => __('messages.name unique'),
//            'price.required' => __('messages.price required'),
//            'price.numeric' => __('messages.price numeric'),
//            'details.required' => __('messages.details required'),
//        ];
//    }

//    protected function getRules(){
//        return $rules = [
//            'name' => 'required|max:100|unique:offers,name',
//            'price' => 'required|numeric',
//            'details' => 'required',
//
//        ];
//    }

    public function getAllOffer()
    {
        $offers = Offer::select('id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
            'price')->get(); // return collection
        return view('offers.all', compact('offers'));
    }

    public function editOffer($offer_id)
    {
//        Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }

    public function deleteOffer($offer_id)
    {
        $offer = Offer::find($offer_id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('messages.error')]);
        }
        $offer->delete();
        return redirect()->back()->with(['successfully' => __('messages.successfully')]);
    }

    public function updateOffer(OfferRequest $request, $offer_id)
    {

        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        //validate
        if (!$offer)
            return redirect()->back();

        //update
        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'تمت العملية بنجاح']);

    }

    public function getVideo()
    {
        $video = Video::first();
        event(new videoViewer($video));
        return view('video')->with('video', $video);
    }
}
