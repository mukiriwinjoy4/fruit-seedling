<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordering;

class OrderingController extends Controller
{
    
    public function readAllOrderings(){
        // $orders = Ordering::all();
        $orders = Ordering::join("users", "orderings.user_id", "=", "users.id")
                            ->join("plants", "orderings.plant_id", "=", "plants.id")
                            ->select("orderings.*", "users.name as user_name", "plants.plant_name as plant_name")
                            ->get();
        if(!$orders){
            return response()->json("No Orders Were found");
        }
        else {
             return response()->json($orders);
        }
    }

    
    public function createOrdering(Request $request){
        $request->validate([
            "quantity"=>"required",
            "user_id"=>"required",
            "plant_id"=>"required"
        ]);
    
        $order = Ordering::create([
            'quantity'=>$request->quantity,
            'user_id'=>$request->user_id,
            'plant_id'=>$request->plant_id
        ]);
    
        return response()->json($order);
    }
    
    
    public function readOrdering($id){
        try{
            $order = Ordering::findOrFail($id);

            if($order){
                return response()->json($order);
            }
            else{
                return response()->json("No Order Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                        'error'=>'Order Does not exist With Such and ID'
            ], 400);
        }
    }

    
    public function updateOrder($id, Request $request){
        try{
            $request->validate([
                "quantity"=>"required",
                "user_id"=>"required",
                "plant_id"=>"required"
            ]);
    
            $order = Ordering::findOrFail($id);
    
            if($order){
                $order->quantity = $request->quantity;
                $order->user_id = $request->user_id;
                $order->plant_id = $request->plant_id;
                $order->save();
    
                return response()->json($order);
            }
            else{
                return response()->json("No Order Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record!'
            ], 400);
        }
    }
    
    
    public function deleteOrder($id){
        try{
            $order = Ordering::findOrFail($id);
            if($order){
                Ordering::destroy($id);
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


