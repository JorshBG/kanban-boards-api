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
            'boards'=> Board::all(),
            'data'=> Board::all()
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

    // List all the boards where the user does not join yet
    public function listByNonUser($user_id): JsonResponse{
        $user_id = $user_id;
        $boards_ids = UserHasBoards::select('board_id')->where('user_id', $user_id)->get();
        // get the boards from the ids
        $boards = Board::whereNotIn('id', $boards_ids)->get();
        // $boards = Board::where('id', 'not like', $boards_ids)->get();
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

    public function delete($board_id): JsonResponse {
        $board = Board::where('id', $board_id)->first();
        if ($board) {
            $board->delete();
            return response()->json([
                'message' => 'Board deleted'
            ], status:201);
        }
        return response()->json([
            'message' => 'Board not found'
        ], status:404);
    }

    public function update(Request $request): JsonResponse {
        $board = Board::where('id', $request->board_id)->first();
        if($board) {
            $board->update($request->all());
            return response()->json([
                'message' => 'Board updated'
            ], status: 201);
        }
        return response()->json([
            'message' => 'Board not found'
        ], status: 404);
    }

    public function get($board_id): JsonResponse {
        $board = Board::where('id', $board_id)->first();
        if ($board) {
            return response()->json([
                'message' => 'board found',
                'data' => $board
            ]);
        }
        return response()->json([
            'message' => 'board not found'
        ], status: 404);
    }

}
