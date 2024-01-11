<?php



use App\Http\Controllers\API\Registration;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MasterController;



/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| is assigned the "api" middleware group. Enjoy building your API!

|

*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});


Route::get('getmemberdata/{id?}', [MasterController::class,'getmemberdata'])->name('getmemberdata');
Route::get('getsinglememberdata/{id?}', [MasterController::class,'getsinglememberdata'])->name('getsinglememberdata');
