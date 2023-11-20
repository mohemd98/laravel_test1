<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CrudController extends Controller
{
    public function __construct()
    {
    }
    public  function getoffer(){
      return    Offer::get();
    }



    public  function  create (){
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

    public  function store(OfferRequest $re){
//        dd($re->all());
        Offer::create([
            'name_ar'=> $re->name_ar,
            'name_en'=> $re->name_en,
            'price'=> $re->price,
            'details_ar'=> $re->details_ar,
            'details_en'=> $re->details_en,

        ]);
        return redirect()->back()->with(['success' => 'good saved']);
    }



public  function getAllOffers(){
  $offers =  Offer::select('id' , 'price',
      'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
      'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
  )->get();


  return view( 'ofers.all' , compact( 'offers'));



}



}
