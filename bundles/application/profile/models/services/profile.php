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
    |--------------------------------------------------------------------------
    | get_id_from_username()
    |--------------------------------------------------------------------------
    | Receives a username to translate into an id. If the value received is already
    | an integer, we simply format the response and send back the id, as there is
    | no translation needed. 
    |
    | @param:     $data - the username/id to look up
    | @return:    integer
    */
    public static function get_id_from_username($data)
    {
        // Received an integer, simply format the return and blast it off.
        if (is_numeric($data)) {
            return array(
                'success' => true,
                'code' => 0,
                'payload' => $data,
            );            
        }

        // Attempt to get the id from the repository
        $id = ProfileRepository::get_id_from_username($data);

        // If the $id returned is false, null or 0, we want to log the error
        // and return a false response.
        if ($id === false || is_null($id) || $id === 0) {
            ErrorApi::log('Could not resolve id for username: '.$data);
            return array(
                'success' => false,
                'code' => 1,
                'payload' => null,
            );
        }

        // At this point, everything was awesome and we've got our id, so let's
        // return a success response.
        return array(
            'success' => true,
            'code' => 0,
            'payload' => $id,
        );
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