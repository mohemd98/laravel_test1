<?php

namespace App\Http\Controllers;

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








    public  function store( Request $re){
        //           rules of input
        $rules=[
            'name'=> 'required|max:100',
            'price'=> 'required|numeric',
            'details'=> 'required',
        ];
        //            error message
        $error_msg = $this->getMSG();
        $val = Validator::make($re->all(), $rules , $error_msg);
        if($val->fails()){
//          return  $val->errors();
            return  $val->errors()->first();
        }
        Offer::create([
            'name'=> $re->name,
            'price'=> $re->price,
            'details'=> $re->details,
        ]);
        return 'good luke';
    }
    protected  function  getMSG()
    {
    return  $error_msg=[
        'name.required'=> 'هذه واجب' ,
        'price.numeric' => 'يجب ان يكون عدد',
    ];
    }






}
