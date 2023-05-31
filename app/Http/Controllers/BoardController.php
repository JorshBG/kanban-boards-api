<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\UserHasBoards;

class BoardController extends Controller
{
    // List all the boards in the database
    public function list(): JsonResponse{

        return response()->json([
            'message' => 'List of boards',
            'boards'=> Board::all()
        ]);

    }

    // List all the boards of the user
    public function listByUser($user_id): JsonResponse{
        $user_id = $user_id;
        $boards_ids = UserHasBoards::select('board_id')->where('user_id', $user_id)->get();
        // get the boards from the ids
        $boards = Board::whereIn('id', $boards_ids)->get();
        return response()->json([
            'message' => 'List of boards',
            'boards'=> $boards
        ]);
    }

    public function create(Request $request): JsonResponse{

        $board = Board::create($request->all());

        if($board){
            return response()->json([
                'message' => 'Board created',
            ]);
        }

        return response()->json([
            'message' => 'Board not created',
        ]);

    }
}
