<?php
Route::get('(:bundle)', array('before'=>'auth', function() {
    return View::make('dashboard::dashboard');
}));