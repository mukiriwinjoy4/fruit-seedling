<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\newplant;

class NewPlantController extends Controller
{
    public function readAllNewPlants(){
        $newPlants = newplant::all();
        if(!$newPlants){
            return response()->json("No New Plant Was found");
        }
        else {
             return response()->json($newPlants);
        }
    }

    public function createNewPlant(Request $request){
        $request->validate([
            "quantity"=>"required",
            "plant_id"=>"required"
        ]);

        $newPlant = newplant::create([
            'quantity'=>$request->quantity,
            'plant_id'=>$request->plant_id
        ]);

        return response()->json($newPlant);
    }

    public function readNewPlant($id){
        try{
            $newPlant = newplant::findOrFail($id);

            if($newPlant){
                return response()->json($newPlant);
            }
            else{
                return response()->json("No New Plant Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                        'error'=>'New Plant Does not exist With Such and ID'
            ], 400);
        }
    }

    public function updateNewPlant($id, Request $request){
        try{
            $request->validate([
                "quantity"=>"required",
                "plant_id"=>"required"
            ]);

            $newPlant = newplant::findOrFail($id);

            if($newPlant){
                $newPlant->quantity = $request->quantity;
                $newPlant->plant_id = $request->plant_id;
                $newPlant->save();

                return response()->json($newPlant);
            }
            else{
                return response()->json("No New Plant Was Found With The ID: ",$id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record!'
            ], 400);
        }
    }

    public function deleteNewPlant($id){
        try{
            $newPlant = newplant::findOrFail($id);
            if($newPlant){
                newplant::destroy($id);
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

