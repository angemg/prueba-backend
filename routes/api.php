<?php

use App\Http\Controllers\Api\V1\RoleChangeRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ChangeRoleController;

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
Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);
Route::post('logout',[UserAuthController::class,'logout'])->middleware('auth:sanctum');
Route::post('request-change-role',[ChangeRoleController::class,'RequestChangeRole'])->middleware('auth:sanctum');
Route::post('change-role/{user}',[ChangeRoleController::class,'ChangeRole'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

JsonApiRoute::server('v1')->prefix('v1')->resources(function (ResourceRegistrar $server) {
        $server->resource('users', JsonApiController::class)
        ->only('index', 'show', 'store');
        $server->resource('role-change-requests', RoleChangeRequests::class)
        ->only('index', 'show', 'store')->actions(function($action){
            $action->post('request-change-role');
            $action->withId()->post('answer-request');
        });
    });