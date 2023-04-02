<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\EcomController;

class AddressController extends EcomController
{
    //

    public function index(Request $request){
        return $this->createView('front.address');
    }
}
