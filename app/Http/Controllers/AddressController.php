<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Classes\EcomController;

use App\Models\Address;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AddressController extends EcomController
{
    //
    public function index(Request $request){
        $data = [];
        $data['addresses'] = $addresses = Address::all();
        //dd($addresses);
        return $this->createView('front.address', $data);
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => 'string',
            'contact' => 'string',
            'email' => 'email',
            'landmark' => 'string',
            'address' => 'string',
            'optradio' => 'string',
            'zip' => 'integer',
            'city' => 'string',
            'state' => 'string'
        ]);
        
        $uuid = Str::uuid();
        $user_id = Auth::user()->uuid;
       
        $address = Address::create([
            'uuid' => $uuid,
            'user_id' => $user_id,
            'name' => $request->name,
            'contact' => $request->contact,
            'email' => $request->email,
            'landmark' => $request->landmark,
            'address' => $request->address,
            'address_type' => $request->optradio,
            'zip' => $request->zip,
            'city' => $request->city,
            'state' => $request->state
        ]);
        
        if($address)
            return redirect(route('address'))->with('success','Product saved successfully');
        else
            return redirect(route('address'))->with('error','Can\'t save product');
    }
}
