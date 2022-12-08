<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeAnswerController;
use App\Http\Controllers\LikeQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::resource('questions', QuestionController::class);
Route::resource('questions.answers', AnswerController::class)->only(['store']);
Route::resource('answers.like', LikeAnswerController::class)->only(['store']);
Route::resource('questions.like', LikeQuestionController::class)->only(['store']);
Route::resource('users', UserController::class)->only(['show', 'update', 'edit']);

Auth::routes();
