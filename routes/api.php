<?php

use App\Http\Controllers\PlantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewPlantController;
use App\Http\Controllers\OrderingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DispatchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::get("/plant", [PlantController::class, 'readAllPlants']);
    // return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post("/plant", [PlantController::class, 'createPlant']);
// Route::get("/plant", [PlantController::class, 'readAllPlants']);
Route::get("/plant/{id}", [PlantController::class, 'readPlant']);
Route::post("/plant/{id}", [PlantController::class, 'updatePlant']);
Route::delete("/plant/{id}", [PlantController::class, 'deletePlant']);

Route::post("/newplant", [NewPlantController::class, 'createNewPlant']);
Route::get("/newplant", [NewPlantController::class, 'readAllNewPlants']);
Route::get("/newplant/{id}", [NewPlantController::class, 'readNewPlant']);
Route::post("/newplant/{id}", [NewPlantController::class, 'updateNewPlant']);
Route::delete("/newplant/{id}", [NewPlantController::class, 'deleteNewPlant']);

Route::post("/ordering", [OrderingController::class, 'createOrdering']);
Route::get("/ordering", [OrderingController::class, 'readAllOrderings']);
Route::get("/ordering/{id}", [OrderingController::class, 'readOrdering']);
Route::post("/ordering/{id}", [OrderingController::class, 'updateOrdering']);
Route::delete("/ordering/{id}", [OrderingController::class, 'deleteOrdering']);


Route::post("/payment", [PaymentController::class, 'createPayment']);
Route::get("/payment", [PaymentController::class, 'readAllPayments']);
Route::get("/payment/{id}", [PaymentController::class, 'readPayment']);
Route::post("/payment/{id}", [PaymentController::class, 'updatePayment']);
Route::delete("/payment/{id}", [PaymentController::class, 'deletePayment']);

Route::post("/dispatch", [DispatchController::class, 'createDispatch']);
Route::get("/dispatch", [DispatchController::class, 'readAllDispatches']);
Route::get("/dispatch/{id}", [DispatchController::class, 'readDispatch']);
Route::post("/dispatch/{id}", [DispatchController::class, 'updateDispatch']);
Route::delete("/dispatch/{id}", [DispatchController::class, 'deleteDispatch']);
