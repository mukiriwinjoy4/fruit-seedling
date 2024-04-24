<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    
    
    public function readAllDispatches(){
        $dispatches = Dispatch::all();
        if(!$dispatches){
            return response()->json("No Dispatch Was found");
        }
        else {
             return response()->json($dispatches);
        }
    }
    
    
    public function createDispatch(Request $request){
        $request->validate([
            "quantity"=>"required",
            "ordering_id"=>"required"
        ]);
    
        $dispatch = Dispatch::create([
            'quantity'=>$request->quantity,
            'ordering_id'=>$request->ordering_id
        ]);
    
        return response()->json($dispatch);
    }
    
    
    public function readDispatch($id){
        try{
            $dispatch = Dispatch::findOrFail($id);
    
            if($dispatch){
                return response()->json($dispatch);
            }
            else{
                return response()->json("No Dispatch Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                        'error'=>'Dispatch Does not exist With Such and ID'
            ], 400);
        }
    }
    
    
    public function updateDispatch($id, Request $request){
        try{
            $request->validate([
                "quantity"=>"required",
                "ordering_id"=>"required"
            ]);
    
            $dispatch = Dispatch::findOrFail($id);
    
            if($dispatch){
                $dispatch->quantity = $request->quantity;
                $dispatch->ordering_id = $request->ordering_id;
    
                $dispatch->save();
    
                return response()->json($dispatch);
            }
            else{
                return response()->json("No Dispatch Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record!'
            ], 400);
        }
    }
    
    
    public function deleteDispatch($id){
        try{
            $dispatch = Dispatch::findOrFail($id);
            if($dispatch){
                Dispatch::destroy($id);
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