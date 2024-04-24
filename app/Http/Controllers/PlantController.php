<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    
    public function readAllPlants(){
        $plants = Plant::all();
        
        if(!$plants->isEmpty()){
             return response()->json($plants);
        } else {
            return response()->json("No Plant Was found");
        }
    }

    
    public function createPlant(Request $request){
        $request->validate([
            "plant_name"=>"required",
            "price"=>"required",
            "image_path"=>"image|mimes:jpeg,png,jpg|max:2048"
        ]);
    
        $filename = null;
        if($request->hasFile("image_path")){
            $filename = $request->file("image_path")->store("plants", "public");
        }
    
        $plant = Plant::create([
            'plant_name'=>$request->plant_name,
            'price'=>$request->price,
            'image_path'=>$filename
        ]);
    
        return response()->json($plant);
    }
    
    
    public function readPlant($id){
        try{
            $plant = Plant::findOrFail($id);

            if($plant){
                return response()->json($plant);
            } else {
                return response()->json("No Plant Was Found With The ID: ", $id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                        'error'=>'Plant Does not exist With Such and ID'
            ], 400);
        }
    }

    
    public function updatePlant($id, Request $request){
        try{
            $request->validate([
                "plant_name"=>"required",
                "price"=>"required",
                "image_path"=>"image|mimes:jpeg,png,jpg|max:2048"
            ]);
    
            $plant = Plant::findOrFail($id);
    
            if($plant){
                $plant->plant_name = $request->plant_name;
                $plant->price = $request->price;
    
                if($request->hasFile("image_path")){
                    $filename = $request->file("image_path")->store("plants", "public");
                    $plant->image_path = $filename;
                }
    
                $plant->save();
    
                return response()->json($plant);
            } else {
                return response()->json("No Plant Was Found With The ID: ", $id);
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record!'
            ], 400);
        }
    }
    
    
    public function deletePlant($id){
        try{
            $plant = Plant::findOrFail($id);
            if($plant){
                Plant::destroy($id);
                return response()->json("Record Has been Successfully Deleted");
            } else {
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

