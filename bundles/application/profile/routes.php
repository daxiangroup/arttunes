<?php
use \Profile\Services\Profile AS ProfileService;

Route::group(array('before'=>'auth'), function() {
    Route::get('/profile/(:any)', function() {
        die(Bundle::name());

        return View::make('profile::profile')
            ->with('profile', ProfileService::get(Auth::user()->id));
    });
});