<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController as ApiTaskController;
use App\Models\User;
use Illuminate\Http\Request;

// Sanctum login route (example)
Route::post('/sanctum/token', function (Request $request) {
    $request->validate(['email'=>'required|email','password'=>'required']);
    $user = \App\Models\User::where('email',$request->email)->first();
    if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['message'=>'Invalid credentials'], 401);
    }
    $token = $user->createToken('api-token')->plainTextToken;
    return response()->json(['token'=>$token]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', ApiTaskController::class)->except(['show']);
});
