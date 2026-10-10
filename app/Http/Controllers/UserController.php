<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function testInsertUser()
    {
        // $user = User::create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password123'),
        //     'remember_token' => \Str::random(10),
        // ]);
        $user = DB::table('users')
            ->select('id', 'name', 'email')
            ->where('id', 1)
            ->first();

        Log::info('DB in use: '.DB::connection()->getDatabaseName());
        $userWithId5 = User::find(1);

        return response()->json([
            'message' => 'User inserted successfully!',
            'user' => $user,
            'user_with_id_5' => $userWithId5,
        ]);
    }
}
