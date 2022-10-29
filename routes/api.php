<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
// });

Route::get('receive', 'UssdController@Request');