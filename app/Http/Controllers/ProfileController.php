<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function getProfileImage()
    {
        $user_id = auth()->user()->id;
        $users = DB::table('users')
            ->where('user_id', $user_id)
            ->get();

        return response()->json(['users' => $users]);
    }

}
