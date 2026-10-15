<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\http\Controllers\QuestionController;
use App\http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[HomeController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');


Route::get('/question/terima-kasih', function () {
    return view('home-question-respon', [
        'nama' => session('nama'),
        'email' => session('email'),
        'pertanyaan' => session('pertanyaan'),
    ]);
})->name('question.success');
