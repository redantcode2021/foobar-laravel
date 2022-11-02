<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Facades\JsonApiRoute;

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

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->namespace('App\Http\Controllers\Api\V1')
    ->resources(function ($server) {

        $server->resource('users')
            ->parameter('id')
            ->relationships(function ($relationships) {
                $relationships->hasMany('tasks');
            });

        $server->resource('tasks')
            ->relationships(function ($relationships) {
                $relationships->hasMany('assignees');
                $relationships->hasOne('creator');
            });
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
