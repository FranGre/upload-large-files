<?php

use App\Http\Controllers\UploadLargeVideoController;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class)->name('welcome');
Route::post('/upload/large/video', UploadLargeVideoController::class)->name('upload.large.video');
