<?php

namespace Profile\Services;

use \Profile\Repositories\Profile AS ProfileRepository;
use \Profile\Entities\Profile AS ProfileEntity;
use \Base\ErrorApi AS ErrorApi;
use \Input;

class Profile
{
    public static function get($id=null)
    {
        $data = (array)ProfileRepository::get($id);

        if ($data === false || is_null($data) || !count($data)) {
            ErrorApi::exception('Could not get a valid profile: '.$id, 'InvalidArgumentException');
        }

        return new ProfileEntity($data);        
    }

    /*
    |--------------------------------------------------------------------------
    | get_id_from_username()
    |--------------------------------------------------------------------------
    | Receives a username to translate into an id. Has the ability to lookup an id
    | as well. If the value received is already an integer (an id), we check to 
    | see if the id exists in the system and format the response and send back the
    | passed in id.
    |
    | @param:     $data - the username/id to look up
    | @return:    integer
    */
    public static function get_id_from_username($data)
    {
        // Initialize the data.
        $id_exists = false;

        // Received an integer, simply format the return and blast it off.
        if (is_numeric($data) && ProfileRepository::id_exists($data)) {
            return array(
                'success' => true,
                'code' => 0,
                'payload' => $data,
            );            
        }

        // If $id_exists is false, an integer was passed in, but the id doesn't
        // exist in the DB.
        if (is_numeric($data) && !$id_exists) {
            ErrorApi::log('Profile id does not exist: '.$data);
            return array(
                'success' => false,
                'code'    => 1,
                'payload' => null,
                'message' => 'The requested Profile does not exist',
            );
            // TODO: Use Lang:: for the response message
        }

        // Attempt to get the id from the repository, since we're dealing with a
        // username.
        $id = ProfileRepository::get_id_from_username($data);

        // If the $id returned is false, null or 0, we want to log the error
        // and return a false response.
        if ($id === false || is_null($id) || $id === 0) {
            ErrorApi::log('Could not resolve id for username: '.$data);
            return array(
                'success' => false,
                'code' => 2,
                'payload' => null,
                'message' => 'The requested Profile does not exist',
                // TODO: use Lang:: for the response message
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