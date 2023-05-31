<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasBoards extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'board_id',
    ];
}
