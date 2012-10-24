<?php
Route::get('(:bundle)', function() {
    // Get the form data
    $form_data = Signup\Services\Signup::form(Session::get('errors'))
        ->get();

    return View::make('signup::signup')
        ->with('form_data', $form_data);
});
Route::post('(:bundle)', function() {
    $validation = Signup\Services\Signup::form()
        ->validate();

    if ($validation->fails()) {
        return \Redirect::to('/signup')
            ->with_input()
            ->with_errors($validation)
            ->with('errors', $validation->errors->messages);
    }

//    \Account\Repositories\Account::save_password();
//    Signup\Repositories\Signup::save();

    return Redirect::to('/dashboard')
        ->with('success', 'save');
});

Route::get('(:bundle)/creator', function() {
    // Get the form data
    $form_data = Signup\Services\SignupCreator::form(Session::get('errors'))
        ->get();

    return View::make('signup::signup-creator')
        ->with('form_data', $form_data);
});
Route::post('(:bundle)/creator', function() {
    $validation = Signup\Services\SignupCreator::form()
        ->validate();

    if ($validation->fails()) {
        return \Redirect::to('/signup/creator')
            ->with_input()
            ->with_errors($validation)
            ->with('errors', $validation->errors->messages);
    }

//    \Account\Repositories\Account::save_password();
//    Signup\Repositories\Signup::save();

    return Redirect::to('/dashboard')
        ->with('success', 'save');
});
