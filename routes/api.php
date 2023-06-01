<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserHasBoardsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\UserHasBoards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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


Route::get('hash/{password}', function ($password) {
    return Hash::make($password);
});

Route::prefix('users')->group(function () {
    // Matches The "/users/list" URL
    // List all the users in the database
    Route::get('/list', [UserController::class, 'list']);
    // Create an user in the database
    Route::post('/signup', [UserController::class, 'signUp']);
    // Sign in an user in the database
    Route::post('/signin', [UserController::class, 'signIn']);
    // Add an user to board
    Route::post('/assign-user', [UserController::class, 'getInBoard']);
    // Get staditistics
    Route::get('/stats', [UserController::class, 'stats']);
    // Delete user
    Route::delete('/delete/{id}', [UserController::class, 'delete']);
    // Update user
    Route::put('/update', [UserController::class, 'update']);
    // get an user
    Route::get('/get/{id}', [UserController::class, 'get']);
});


Route::prefix('roles')->group(function () {
    // Matches The "/users/list" URL
    // List all the roles in the dtabase
    Route::get('/list', [RoleController::class, 'list']);
    // Create an role
    Route::post('/create', [RoleController::class, 'create']);
});

Route::prefix('boards')->group(function () {
    // Matches The "/users/list" URL
    // List all the roles in the dtabase
    Route::get('/list', [BoardController::class, 'list']);
    // List all the boards by user
    Route::get('list-by-user/{user_id}', [BoardController::class, 'listByUser']);
    // Create an role
    Route::post('/create', [BoardController::class, 'create']);
    // Search boards where the user does not join yet
    Route::get('list-by-non-user/{user_id}', [BoardController::class, 'listByNonUser']);
    // Delete board
    Route::delete('/delete/{id}', [BoardController::class, 'delete']);
    // Update board
    Route::put('/update', [BoardController::class, 'update']);
    // Get a board
    Route::get('/get/{id}', [BoardController::class, 'get']);
});


Route::prefix('activities')->group(function () {

    Route::get('/list/{board_id}', [ActivityController::class, 'list']);
});


Route::prefix('join')->group(function () {
    // Route to join a board
    Route::post('/board', [UserHasBoardsController::class, 'join']);
});
