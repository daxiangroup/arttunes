<?php
Route::get('/signup', function() {
    // Get the form data
    $form_data = Signup\Services\Signup::form(Session::get('errors'))
        ->get();

    return View::make('signup::signup')
        ->with('form_data', $form_data);
});
Route::post('/signup', array('before'=>'csrf', function() {
    $validation = Signup\Services\SignupValidator::make();

    if ($validation->fails()) {
        return \Redirect::to('/signup')
            ->with_input()
            ->with_errors($validation)
            ->with('errors', $validation->errors->messages);
    }

    $success = Signup\Repositories\Signup::save();

    if (!$success['success']) {
        return \Redirect::to('/signup')
            ->with('errors', $success);
    }

    return Redirect::to('/dashboard')
        ->with('success', 'save');
}));