<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Board;
use App\Models\Role;
use App\Models\User;
use App\Models\UserHasBoards;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signIn(Request $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $role = Role::where('id', $user->role_id)->first();
                return response()->json([
                    'message' => 'User logged in successfully',
                    'data' => $user,
                    'role' => $role->name
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

    public function signUp(Request $request): JsonResponse
    {
        $user = User::create($request->all());
        if ($user) {
            return response()->json([
                'message' => 'User created successfully'
            ], status: 201);
        }
        return response()->json([
            'message' => 'User creation failed'
        ]);
    }

    public function get($user_id): JsonResponse {
        $user = User::where('id', $user_id)->first();
        if ($user) {
            return response()->json([
                'message' => 'User found',
                'data' => $user
            ]);
        }
        return response()->json([
            'message' => 'User not found'
        ], status:404);
    }

    public function delete($user_id): JsonResponse {
        $user = User::where('id', $user_id)->first();
        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted'
            ], status:201);
        }
        return response()->json([
            'message' => 'User not found'
        ], status:404);
    }

    public function update(Request $request): JsonResponse {
        $user = User::where('id', $request->user_id)->first();
        if($user) {
            $user->update($request->all());
            return response()->json([
                'message' => 'User updated'
            ], status: 201);
        }
        return response()->json([
            'message' => 'User not found',
            // 'user'=> $request->all(),
        ], status: 404);
    }

    public function list(): JsonResponse
    {
        return response()->json([
            'message' => 'User list',
            'users' => User::all(),
            'data' => User::all(),
        ]);
    }

    public function getInBoard(Request $request)
    {
        $user_has_board = UserHasBoards::create($request->all());
        if ($user_has_board) {
            return response()->json([
                'message' => 'User added to board'
            ]);
        }
        return response()->json([
            'message' => 'User adding to board failed'
        ]);
    }

    public function stats(): JsonResponse
    {
        $no_users = User::count();
        $no_boards = Board::count();
        $no_activities = Activity::count();

        return response()->json([
            'message' => 'Stats',
            'stats' => [
                [
                    'stat' => $no_users ?? 0,
                    'title' => 'Users'
                ],
                [
                    'stat' => $no_boards ?? 0,
                    'title' => 'Boards'
                ],
                [
                    'stat' => $no_activities ?? 0,
                    'title' => 'Activities'
                ]
            ]
        ]);
    }

    // public function

}
