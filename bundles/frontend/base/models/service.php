<?php

namespace Base;

use \Base\Utility;

class Service
{
    protected $_form_data = null;

    protected function massage_form_data($form_data)
    {
        return Utility::massage_form_data($form_data);
    }

    public function get()
    {
        return $this->_form_data;
    }

    public function set($data)
    {
        $this->_form_data = $data;
        return true;
    }

    public function validate($input=null, $rules=null, $messages=null)
    {
        // If the $input variable is null, automatically set it to Input::all().
        if (is_null($input)) {
            $input = \Input::all();
        }

        // If our $input array is empty, throw an exception (we NEED an array to
        // validate through).
        if (count($input) === 0) {
            throw new \InvalidArgumentException('Base\Service: $input cannot be empty');
        }

        // If $rules is null or it's an empty array, set the value to the object's
        // rules. We need rules to validate the above $input against.
        if (is_null($rules) || count($rules) === 0) {
            $rules = $this->_validation_rules;
        }

        // If $messages is null or it's an empty array AND the object's messages is
        // not null and not empty, set the messages value to the object's messages.
        if ((is_null($messages) || count($messages) === 0) && !is_null($this->_validation_messages) 
            && count($this->_validation_messages) !== 0) {
            $messages = $this->_validation_messages;
        }

        return \Validator::make($input, $rules, $messages);
    }
}