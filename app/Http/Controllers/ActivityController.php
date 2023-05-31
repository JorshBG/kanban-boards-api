<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ActivityController extends Controller
{
    public function list($board_id): JsonResponse{
        $activities = Activity::where('board_id', $board_id)->get();

        if($activities){
            return response()->json([
                'message' => 'activities listed',
                'activities' => $activities,
            ]);
        }

        return response()->json([
            'message' => 'activities not listed',
        ], status: 404);

    }
}
