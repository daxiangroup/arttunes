<?php

namespace Signup\Services;

use \Input;

class SignupValidator extends \Base\Validator
{
    protected $_validation_rules    = array();
    protected $_validation_messages = array();

    public static function make()
    {
        $_instance = new self;

        // Create the rules to validation this object
        $validation_rules = array(
            'signup-first-name'        => 'required|alpha',
            'signup-last-name'         => 'required|alpha',
            'signup-email'             => 'required|email|unique:accounts,email',
            'signup-password'          => 'required',
            'signup-password-verify'   => 'required|same:signup-password',
            'signup-about-me'          => 'required',
            'signup-general-statement' => 'required',
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

        $_instance->_validation_rules    = $validation_rules;
        $_instance->_validation_messages = array();

        return $_instance->validate();
    }
}