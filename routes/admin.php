<?php

use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        });


        Route::prefix('/catalogues')
            ->as('catalogues.')
            ->group(function () {
                Route::get('/', [CatalogueController::class, 'index'])->name('index');
                Route::get('/create', [CatalogueController::class, 'create'])->name('create');
                Route::post('/store', [CatalogueController::class, 'store'])->name('store');
                Route::get('/show/{id}', [CatalogueController::class, 'show'])->name('show');
                Route::get('/edit/{id}', [CatalogueController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [CatalogueController::class, 'update'])->name('update');
                Route::get('/destroy/{id}', [CatalogueController::class, 'destroy'])->name('destroy');
            });
        Route::resource('/products', ProductController::class);
    });