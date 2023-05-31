<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // List all roles in the Database
    public function list(): JsonResponse{
        return response()->json([
            'message'=>'Roles listed',
            'roles'=> Role::all()
        ]);
    }
}
