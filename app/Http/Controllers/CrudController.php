<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function __construct()
    {
    }
    public  function getoffer(){
      return    Offer::get();
    }


}
