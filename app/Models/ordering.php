<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordering extends Model
{
    use HasFactory;

    protected $fillable =[
        "quantity",
        "user_id",
        "plant_id"
    ];
}
