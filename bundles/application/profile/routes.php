<?php
use \Profile\Services\Profile AS ProfileService;

Route::group(array('before'=>'auth'), function() {
    // Temporary route, this will likely be rewritten. For now, it redirects to
    // the logged in user's galleries.
    Route::get('/profile', function() {
        return Redirect::to('/profile/'.Auth::user()->username);
    });

    Route::get('/profile/(:any)', function() {
        $success = ProfileService::get_id_from_username(URI::segment(2));

        if (!$success['success']) {
            return Redirect::to('/profile/'.Auth::user()->username);
        }

        $id = $success['payload'];

        return View::make('profile::profile')
            ->with('profile', ProfileService::get($id));
    });
});