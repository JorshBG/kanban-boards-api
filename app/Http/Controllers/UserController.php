<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Board;
use App\Models\User;
use App\Models\UserHasBoards;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signIn(Request $request): JsonResponse{
        $user = User::where('email', $request->email)->first();
        if($user){
            if(password_verify($request->password, $user->password)){
                return response()->json([
                    'message' => 'User logged in successfully',
                    'data' => $user,
                ]);
            }
            return response()->json([
                'message' => 'Invalid password'
            ], status: 401);
        }
        return response()->json([
            'message' => 'User not found'
        ], status: 404);
    }

    public function signUp(Request $request): JsonResponse{
        $user = User::create($request->all());
        if($user){
            return response()->json([
                'message' => 'User created successfully'
            ]);
        }
        return response()->json([
            'message' => 'User creation failed'
        ]);
    }

    public function list(): JsonResponse {
        return response()->json([
            'message' => 'User list',
            'users' => User::all(),
        ]);
    }

    public function getInBoard(Request $request){
        $user_has_board = UserHasBoards::create($request->all());
        if($user_has_board){
            return response()->json([
                'message' => 'User added to board'
            ]);
        }
        return response()->json([
            'message' => 'User adding to board failed'
        ]);
    }

    public function getStats(): JsonResponse{
        $no_users = User::count();
        $no_boards = Board::count();
        $no_activities = Activity::count();

        return response()->json([
            'message' => 'Stats',
            'no_users' => $no_users??0,
            'no_boards' => $no_boards??0,
            'no_activities' => $no_activities??0
        ]);
    }

    // public function

}
