<?php
Route::get('/login', function() {
    // Get the form data
    $form_data = Login\Services\Login::form(Session::get('errors'))
        ->get();

    return View::make('login::login')
        ->with('form_data', $form_data);
});
Route::post('/login', array('before'=>'csrf', function() {
    $validation = Login\Services\LoginValidator::make();

    if ($validation->fails()) {
        return \Redirect::to('/login')
            ->with_input()
            ->with_errors($validation)
            ->with('errors', $validation->errors->messages);
    }

    $credentials = array('username' => Input::get('login-email'), 'password' => Input::get('login-password'));

    if (Auth::attempt($credentials)) {
        return Redirect::to('/dashboard');
    }

    return Redirect::to('/login');
}));