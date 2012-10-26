<?php

namespace Signup\Services;

use \Auth;
use \Input;

class Signup extends \Base\Service
{
    protected $_validation_rules    = array();
    protected $_validation_messages = array();

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
                'value' => Input::old('signup-first-name'),
                'extra' => array(
                    'autofocus'=>'',
                    'class'=>(isset($error_object['signup-first-name']) ? 'error' : '')
                ),
                'target' => 'signup-first-name',
                'label' => 'First Name',
            ),
            'signup-last-name' => array(
                'name' => 'signup-last-name',
                'value' => Input::old('signup-last-name'),
                'target' => 'signup-last-name',
                'label' => 'Last Name',
            ),
            'signup-email' => array(
                'name' => 'signup-email',
                'value' => Input::old('signup-email'),
                'target' => 'signup-email',
                'label' => 'Email',
            ),
            'signup-password' => array(
                'name' => 'signup-password',
                'target' => 'signup-password',
                'label' => 'Password',
            ),
            'signup-password-verify' => array(
                'name' => 'signup-password-verify',
                'target' => 'signup-password-verify',
                'label' => 'Verify Password',
            ),            
            'signup-type-1' => array(
                'name' => 'signup-type',
                'value' => bndlSIGNUP_ArtLover,
                'checked' => (Input::old('signup-type') == bndlSIGNUP_ArtLover || !Input::has('signup-type') ? true : false),
                'extra' => array('id' => 'signup-type-1'),
                'target' => 'signup-type-1',
                'label' => 'Art Lover',
            ),
            'signup-type-2' => array(
                'name' => 'signup-type',
                'value' => bndlSIGNUP_ArtCreator,
                'checked' => (Input::old('signup-type') == bndlSIGNUP_ArtCreator ? true : false),
                'extra' => array('id' => 'signup-type-2'),
                'target' => 'signup-type-2',
                'label' => 'Creator',
            ),
            'signup-about-me' => array(
                'name' => 'signup-about-me',
                'target' => 'signup-about-me',
                'label' => 'About Me',
            ),
            'signup-general-statement' => array(
                'name' => 'signup-general-statement',
                'target' => 'signup-general-statement',
                'label' => 'General Artist Statement',
            ),


            'btn-submit'   => array(
                'value'   => 'Signup',
                'extra'   => array(
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        $this->_form_data = $this->massage_form_data($form_data);
    }

    protected function prepare_validation()
    {
        // Create the rules to validation this object
        $validation_rules = array(
            'signup-first-name'        => 'required|alpha',
            'signup-last-name'         => 'required|alpha',
            'signup-email'             => 'required|email',
            'signup-password'          => 'required',
            'signup-password-verify'   => 'required|same:signup-password',
            'signup-about-me'          => 'required|alpha_dash',
            'signup-general-statement' => 'required|alpha_dash',
        );

        // Custom error messages for this validation
        $validation_messages = array(
            'same'             => 'Your new password must match the verification',
        );

        // If the user is signing up as an 'Art Lover', we want to remove the 
        // validation rules for an 'Art Creator', as they don't apply...
        if (Input::get('signup-type') == bndlSIGNUP_ArtLover) {
            unset($validation_rules['signup-about-me']);
            unset($validation_rules['signup-general-statement']);
        }

        $this->_validation_rules    = $validation_rules;
        $this->_validation_messages = array();
    }
}