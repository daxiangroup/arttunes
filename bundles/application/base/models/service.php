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
}