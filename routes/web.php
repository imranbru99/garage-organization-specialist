<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services.index');
    Route::get('/services/{slug}', 'serviceShow')->name('services.show');
    Route::get('/blog', 'blog')->name('blog.index');
    Route::get('/blog/{slug}', 'blogShow')->name('blog.show');
    Route::get('/knowledge-base', 'knowledge')->name('kb.index');
    Route::get('/knowledge-base/{slug}', 'knowledgeShow')->name('kb.show');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactStore')->name('contact.store');
    Route::post('/ai/chat', 'chat')->name('ai.chat');
});
