<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;

class OfferController extends Controller
{
    //
//    use  OfferTrait;
    public function create()
    {
        return view('ajaxoffers.create');
    }

    public function store(Request $request)
    {
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
    }
}
