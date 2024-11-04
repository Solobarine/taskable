<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'index')->name('projects');
    Route::get('/projects/create', 'create')->name('projects.create');
    Route::post('/projects', 'store')->name('projects.store');
    Route::get('/projects/{project}', 'show')->name('projects.show');
    Route::get('/projects/{project}/edit', 'edit')->name('projects.edit');
    Route::patch('/projects/{project}', 'update')->name('projects.update');
    Route::delete('/projects/{project}', 'destroy')->name('projects.destroy');
});
