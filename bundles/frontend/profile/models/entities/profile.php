<?php

namespace Profile\Entities;

class Profile {
    public $first_name;
    public $last_name;
    public $email;

    public function __construct($data=array())
    {
        $this->first_name = $data['first_name'] ? $data['first_name'] : '';
        $this->last_name = $data['last_name'] ? $data['last_name'] : '';
        $this->full_name = ($data['first_name'] && $data['last_name']) ? $data['first_name'].' '.$data['last_name'] : '';
        $this->email = $data['email'] ? $data['email'] : '';
    }
}