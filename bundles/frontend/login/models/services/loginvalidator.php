<?php

namespace Login\Services;

use \Input;

class LoginValidator extends \Base\Validator
{
    public static function make()
    {
        $_instance = new self;

        // Create the rules to validation this object
        $validation_rules = array(
            'login-email'    => 'required|email',
            'login-password' => 'required',
        );

        $_instance->_validation_rules = $validation_rules;

        return $_instance->validate();
    }
}