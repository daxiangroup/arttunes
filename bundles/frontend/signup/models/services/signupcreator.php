<?php

namespace Signup\Services;

use \Auth;

class SignupCreator extends Signup
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
            'signup-about-me' => array(
                'name' => 'signup-about-me',
                'extra' => array('id'=>'signup-about-me'),
                'target' => 'signup-about-me',
                'label' => 'About Me',
            ),
            'signup-general-statement' => array(
                'name' => 'signup-general-statement',
                'extra' => array('id'=>'signup-general-statement'),
                'target' => 'signup-general-statement',
                'label' => 'General Artist Statement',
            ),
        );

        $form_data = array_merge($form_data, parent::form()->get());
        
        $this->_form_data = $this->massage_form_data($form_data);
    }

    protected function prepare_validation()
    {
        // Create the rules to validation this object
        $validation_rules = array(
            'signup-general-statement' => 'required',
        );
        die('<pre>'.print_r($this,true));
        $this->_validation_rules = array_merge($validation_rules, parent::form()->prepare_validation());

        // Custom error messages for this validation
        $this->_validation_messages = array(
            'same'             => 'Your new password must match the verification',
        );
    }    
}