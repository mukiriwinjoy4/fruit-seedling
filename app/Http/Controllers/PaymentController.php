<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    
    public function readAllPayments(){
        $payments = Payment::all();
        if(!$payments){
            return response()->json("No Payments Were found");
        }
        else {
             return response()->json($payments);
        }
    }

    
    public function createPayment(Request $request){
        $request->validate([
            "amount"=>"required",
            "user_id"=>"required"
        ]);
    
        $payment = Payment::create([
            'amount'=>$request->amount,
            'user_id'=>$request->user_id
        ]);
    
        return response()->json($payment);
    }
    
    
    public function readPayment($id){
        try{
            $payment = Payment::findOrFail($id);

            if($payment){
                return response()->json($payment);
            }
            else{
                return response()->json("No Payment Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                        'error'=>'Payment Does not exist With Such and ID'
            ], 400);
        }
    }

    
    public function updatePayment($id, Request $request){
        try{
            $request->validate([
                "amount"=>"required",
                "user_id"=>"required"
            ]);
    
            $payment = Payment::findOrFail($id);
    
            if($payment){
                $payment->amount = $request->amount;
                $payment->user_id = $request->user_id;
                $payment->save();
    
                return response()->json($payment);
            }
            else{
                return response()->json("No Payment Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record!'
            ], 400);
        }
    }
    
    
    public function deletePayment($id){
        try{
            $payment = Payment::findOrFail($id);
            if($payment){
                Payment::destroy($id);
                return response()->json("Record Has been Successfully Deleted");
            }
            else{
                return response()->json("Record Does not exist with the ID: ", $id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Record Not Deleted!'
                ], 400);
        }
    }
}

