<?php
use \Profile\Services\Profile AS ProfileService;

Route::group(array('before'=>'auth'), function() {
    Route::get('(:bundle)/(:any)', function() {
        return View::make('profile::profile')
            ->with('profile', ProfileService::get(Auth::user()->id));
    });
});