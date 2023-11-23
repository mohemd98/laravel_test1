<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;

class OfferController extends Controller
{
    //
    use  OfferTrait;
    public function create()
    {
        return view('ajaxoffers.create');
    }

    public function store(Request  $request)
    {
        $file_name = $this->saveImage($request->photo, 'images/offers');

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
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);
    }
}
