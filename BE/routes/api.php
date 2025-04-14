<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('sendverify', [UserController::class, 'sendverify'])->name('sendverify');
Route::middleware('auth:api')->resource('category', CategoryController::class);
Route::middleware('auth:api')->resource('post', PostController::class);
Route::middleware('auth:api')->post('post/{id}/Like', function (Request $request, $id) {
    $post = Post::find($id);
    $user = $request->user();
    $post->Likes()->sync([$user->id]);
    return response()->json(['status' => true]);
});
Route::middleware('auth:api')->post('post/{id}/unLike', function (Request $request, $id) {
    $post = Post::find($id);
    $user = $request->user();
    $post->Likes()->detach([$user->id]);
    return response()->json(['status' => true]);
});
