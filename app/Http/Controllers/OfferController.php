<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;

    public function all()
    {
        $offers = Offer::select('id',
            'price',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details'
        )->limit(10)->get(); // return collection
        return view('ajax-offers.all', compact('offers'));
    }

    public function create()
    {
        return view('ajax-offers.create');
    }

    public function store(Request $request)
    {
        $file_name = $this->saveImages($request->photo, 'images/offers');

        //move photo

        //insert ////////////////
        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,

        ]);

        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);
        else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاولة مجددا',
            ]);
    }

    public function edit(Request $request)
    {
//        Offer::findOrFail($offer_id);
        $offer = Offer::find($request->offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود'
            ]);
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($request->offer_id);
        return view('ajax-offers.edit', compact('offer'));
    }

    public function update(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        //validate
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذا العرض غير موجود',
            ]);

        //update
        $offer->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'تم التحديث بنجاح',
        ]);
    }

    public function delete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer) {
            return redirect()->back()->with(['error' => __('messages.error')]);
        }
        $offer->delete();
        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' => $request->id
        ]);
    }
}



