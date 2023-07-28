<?php

use App\Http\Controllers\UniversityController;
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
    return $request->user();
});

Route::get("/university", [UniversityController::class, 'index']);


// get university detail based on its name or abbrevation 
Route::get('/university/details/{name}', [UniversityController::class, 'getUniversityDetailsByName']);

// get university detail based on its name or abbrevation 
Route::get('/university/details/state/{name}', [UniversityController::class, 'getStateUniversityDetailsInState']);






// ----------------------------- -----------------------------//

// get all the universities in a particular city
Route::get('/university/city/{city}', [UniversityController::class, 'getUniversitiesInCity']);

// get all the universities in a particular state
Route::get('/university/state/{state}', [UniversityController::class, 'getUniversitiesInState']);





// ----------------------------- -----------------------------//
// get all the private universities
Route::get('/university/private/', [UniversityController::class, 'getAllPrivateUniversities']);

// get all the private universities in a particular state
Route::get('/university/private/{state}', [UniversityController::class, 'getPrivateUniversitiesInState']);



// ----------------------------- -----------------------------//
// get all the [federal]  universities
Route::get('/university/federal/', [UniversityController::class, 'getAllFederalUniversities']);

// get all the [federal] universities in a particular state
Route::get('/university/federal/{state}', [UniversityController::class, 'getFederalUniversitiesInState']);


// ----------------------------- -----------------------------//
// get all the [state]  universities
Route::get('/university/state/', [UniversityController::class, 'getAllStateUniversities']);

// get all the [state] universities in a particular state
Route::get('/university/state/{state}', [UniversityController::class, 'getStateUniversitiesInState']);