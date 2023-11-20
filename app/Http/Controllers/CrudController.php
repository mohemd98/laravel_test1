<?php

namespace App\Http\Controllers;

use App\Events\videoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;

//use Dotenv\Validator;
use App\Models\video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use  OfferTrait;

    public function __construct()
    {
    }

    public function getoffer()
    {
        return Offer::get();
    }

    public function create()
    {
        return view('ofers.create');
    }
//    public  function store( Request $re){
//        //           rules of input
//        $rules=[
//            'name'=> 'required|max:100',
//            'price'=> 'required|numeric',
//            'details'=> 'required',
//        ];
//        //            error message
//        $error_msg = $this->getMSG();
//        $val = Validator::make($re->all(), $rules , $error_msg);
//        if($val->fails()){
////          return  $val->errors();
////            return  $val->errors()->first();
//            return redirect()->back()->withErrors($val)->withInput($re->all());
//
//        }
//        Offer::create([
//            'name'=> $re->name,
//            'price'=> $re->price,
//            'details'=> $re->details,
//        ]);
//        return redirect()->back()->with(['success' => 'good saved']);
//    }
//    protected  function  getMSG()
//    {
//    return  $error_msg=[
//        'name.required'=> __( 'messages.offer name required'),
//        'price.numeric' => __( 'messages.offer name must be unique'),
//    ];
//    }

    public function store(OfferRequest $re)
    {
//        dd($re->all());
//        $file_extension = $re->photo->getClientOriginalExtension();
//        $file_name = time() . '.' . $file_extension;
//        $path = 'images/offers';
//        $re->photo->move($path, $file_name);
        $file_name = $this->saveImage($re->photo, 'images/offers');
        Offer::create([
            'name_ar' => $re->name_ar,
            'name_en' => $re->name_en,
            'price' => $re->price,
            'details_ar' => $re->details_ar,
            'details_en' => $re->details_en,
            'photo' => $file_name,
        ]);
        return redirect()->back()->with(['success' => 'good saved']);
    }

    public function getAllOffers()
    {
        $offers = Offer::select('id', 'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
        )->get();

        return view('ofers.all', compact('offers'));
    }


    public function editOffer($offer_id)
    {
        // Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id);  // search in given table id only
        //علمود الحمايه
        if (!$offer)
            return redirect()->back();
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        return view('ofers.edit', compact('offer'));
    }

    public function UpdateOffer(OfferRequest $request, $offer_id)
    {
        //validtion
        // chek if offer exists
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back();
        //update data
        $offer->update($request->all());
        return redirect()->back()->with(['success' => ' تم التحديث بنجاح ']);
        /*  $offer->update([
              'name_ar' => $request->name_ar,
              'name_en' => $request->name_en,
              'price' => $request->price,
          ]);*/
    }

    public function getVideo(){

       $video =  video::first();
event(new videoViewer($video));
        return view('video')->with('video' , $video);
    }

    public function delete($offer_id)
    {
        //check if offer id exists

        $offer = Offer::find($offer_id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => __('messages.offer not exist')]);

        $offer->delete();

        return redirect()
            ->route('offers.all')
            ->with(['success' => __('messages.offer deleted successfully')]);

    }


}
