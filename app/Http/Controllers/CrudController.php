<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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

        Offer::create([
            'name'=> $re->name,
            'price'=> $re->price,
            'details'=> $re->details,
        ]);
        return redirect()->back()->with(['success' => 'good saved']);
    }







}
