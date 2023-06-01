<?php

namespace App\Http\Controllers;

use App\Models\UserHasBoards;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserHasBoardsController extends Controller
{
    public function join(Request $request): JsonResponse{
        $relation = UserHasBoards::create($request->all());
        if($relation){
            return response()->json([
                'message' => 'User joined successfully'
            ]);
        }
        return response()->json([
            'message' => 'Something went wrong'
        ], status: 500);
    }
}
