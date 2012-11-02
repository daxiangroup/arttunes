<?php
use \Galleries\Services\Galleries AS GalleriesService;
use \Profile\Services\Profile AS ProfileService;

Route::group(array('before'=>'auth'), function() {
    // Temporary route, this will likely be rewritten. For now, it redirects to
    // the logged in user's galleries.
    Route::get('/galleries', function() {
        return Redirect::to('/galleries/'.Auth::user()->username);
    });

    Route::get('/galleries/(:any)', function() {
        $success = ProfileService::get_id_from_username(URI::segment(2));

        if (!$success['success']) {
            return Redirect::to('/galleries/'.Auth::user()->username);
        }

        $id = $success['payload'];

        return View::make('galleries::galleries')            
            ->with('profile', ProfileService::get($id))
            ->with('galleries', GalleriesService::get()->by_account_id($id));
    });
});