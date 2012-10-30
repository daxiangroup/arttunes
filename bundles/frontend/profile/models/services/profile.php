<?php

namespace Profile\Services;

use \Profile\Repositories\Profile AS ProfileRepository;
use \Auth;
use \Input;

class Profile
{
    public static function get($id=null)
    {
        return ProfileRepository::get($id);
    }
    /*
    public static function details($id=null)
    {
        $id = 5;
        return array(
            'name' => ProfileRepository::get_full_name($id),
            'email' => ProfileRepository::get_email($id),
        );
    }
    */

    public static function form($error_object=null)
    {
        $_instance = new self;

        $_instance->prepare_form_data($error_object);

        return $_instance;
    }

    /*
    |--------------------------------------------------------------------------
    | prepare_form_data()
    |--------------------------------------------------------------------------
    | Prepares the array that is used in the views to create the signup form to 
    | the user. Private function that is called by the form() singleton when 
    | being statically called.
    |
    | @singleton: form
    | @return:    array
    */
    protected function prepare_form_data($error_object)
    {
        $form_data = array(
            'login-email' => array(
                'name' => 'login-email',
                'value' => Input::old('login-email'),
                'extra' => array(
                    'autofocus' => '',
                ),
                'target' => 'login-email',
                'label' => 'Email',
            ),
            'login-password' => array(
                'name' => 'login-password',
                'target' => 'login-password',
                'label' => 'Password',
            ),

            'btn-submit'   => array(
                'value'   => 'Login',
                'extra'   => array(
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        $this->_form_data = $this->massage_form_data($form_data);
    }
}