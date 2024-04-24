<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plant extends Model
{
    use HasFactory;
    protected $fillable =[
        "plant_name",
        "price",        
        "image_path"
    ];
}
