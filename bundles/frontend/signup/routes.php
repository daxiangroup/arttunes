<?php
Route::get('(:bundle)', function() {
   return View::make('signup::signup');
});