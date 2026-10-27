<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\http\Controllers\QuestionController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\PelangganController;
use App\Http\Controllers\BiodataController;

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

Route::resource('pelanggan', PelangganController::class);

Route::redirect('/', '/biodata');

Route::resource('biodata', BiodataController::class)
    ->parameters(['biodata' => 'biodata']);
