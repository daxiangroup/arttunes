<?php

namespace Signup\Services;

use \Auth;

class Signup extends \Base\Service
{
    public static function form($error_object=null)
    {
        $_instance = new self;

        $_instance->prepare_form_data($error_object);
        $_instance->prepare_validation();

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
            'signup-first-name' => array(
                'name' => 'signup-first-name',
                'extra' => array(
                    'id'=>'signup-first-name',
                    'autofocus'=>'',
                    'class'=>(isset($error_object['signup-first-name']) ? 'error' : '')
                ),
                'target' => 'signup-first-name',
                'label' => 'First Name',
            ),
            'signup-last-name' => array(
                'name' => 'signup-last-name',
                'extra' => array('id'=>'signup-last-name'),
                'target' => 'signup-last-name',
                'label' => 'Last Name',
            ),
            'signup-email' => array(
                'name' => 'signup-email',
                'extra' => array('id'=>'signup-email'),
                'target' => 'signup-email',
                'label' => 'Email',
            ),            

            'btn-submit'   => array(
                'value'   => 'Signup',
                'extra'   => array(
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        $this->_form_data = $this->massage_form_data($form_data);
        return $this->_form_data;
    }

    protected function prepare_validation()
    {
        // Custom validation rule to verify that the current password being
        // entered matches the user logged in
//        \Validator::register('current_password', function() use ($input) {
//            return \Hash::check($input['password-current'], \Auth::user()->password);
//        });

        // Create the rules to validation this object
        $this->_validation_rules = array(
            'signup-first-name' => 'required',
            /*
            'password-current' => 'required|current_password',
            'password-new'     => 'required|different:password-current',
            'password-verify'  => 'required|same:password-new',
            */
        );

        // Custom error messages for this validation
        $this->_validation_messages = array(
            'current_password' => 'Current password does not match our records',
            'different'        => 'Your new passowrd must be different than your current password',
            'same'             => 'Your new password must match the verification',
        );
    }
}