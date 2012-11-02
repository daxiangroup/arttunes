<?php
Route::get('/dashboard', array('before'=>'auth', function() {
    return View::make('dashboard::dashboard');
}));