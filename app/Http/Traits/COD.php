<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\User;

trait COD{
    public function getCodPayment(Request $request){
        $request->validate([
            'cheque_dd_number' => 'required|string',
            'order_id' => 'required|string',
            'mode' => 'required|string',
            'bank_name' => 'string',
            'amount' => 'required|integer',
            'fill_amount' => 'required|integer',
        ]);
        
        $uuid = Str::uuid();
        $transaction_id = Helper::randomString(12,'RXTNCQ-');
        $payments = 0;
        if( ( $request->amount <= $request->fill_amount ) && ( $receiving_amount <= $request->amount ) ){
            $flag = true;
            $payments = Payment::create([
                'id' => $uuid,
                'transaction_id' => $transaction_id,
                'order_id' => $request->order_id,
                'mode' => $request->mode,
                'cheque_dd_number' => $request->cheque_dd_number,
                'bank_name' => $request->bank_name,
                'amount' => $request->amount,
                'payment_status' => 'SUCCESS'
            ]);
        } 
        
        $to_name = 'arvind';
        $to_email = 'arvindpandeymail@gmail.com';
        $dat = array('name' => $to_name, 'body' => 'Order Successfull');

        Mail::send('emails.order_mail', $dat, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('order successfull');
                $message->from('help@icarehomeo.com', 'Order Mail');
            }
        );
    }
}
