<?php

use App\Http\Controllers\AgreementController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolFinancePackageController;
use App\Http\Controllers\YouTubeLiveStreamingController;
use Illuminate\Support\Facades\Route;

// Rute untuk entitas Schools
Route::resource('schools', SchoolController::class);
Route::get('/schools/{school}', [SchoolController::class, 'show'])->name('schools.show');
// Penjelasan: Mengelola sekolah (Schools), kecuali menampilkan detail sekolah.

// Rute untuk entitas Agreements
Route::resource('agreements', AgreementController::class);
Route::get('/agreements/{agreement}/print', [AgreementController::class, 'print'])->name('agreements.print');
Route::get('/schools/{school}/agreements', 'AgreementController@create');

// Penjelasan: Mengelola perjanjian (Agreements), kecuali menampilkan detail perjanjian.

// Rute untuk entitas School Finance Packages
Route::resource('school-finance-packages', SchoolFinancePackageController::class);
Route::get('school_finance_packages/create/{id}', 'SchoolFinancePackageController@create');


// Penjelasan: Mengelola paket pembiayaan sekolah (School Finance Packages), kecuali menampilkan detail paket pembiayaan sekolah.

// Rute untuk entitas Finances
Route::resource('finances', FinanceController::class);
Route::get('finances/{id}/print-invoice', [FinanceController::class, 'printInvoice'])->name('finances.printInvoice');

// Penjelasan: Mengelola data keuangan (Finances), kecuali menampilkan detail data keuangan.

Route::get('/start-live-stream', [YouTubeLiveStreamingController::class, 'startLiveStream'])->name('start-live-stream');
