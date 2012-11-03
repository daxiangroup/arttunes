<?php

namespace Profile\Repositories;

use \Profile\Entities\Profile AS ProfileEntity;
use \Base\ErrorApi;
use \Auth;
use \DB;
use \Hash;
use \Input;

class Profile extends \Base\Repository {

    public static function get($id)
    {
        // Initialize response
        $data = false;

        try {
            $data = DB::connection('application_r')
                ->table('accounts')
                ->where('id', '=', $id)
                ->first();
        }
        // Thow an exception if we have a DB problem 
        catch (\Exception $e) {
            ErrorApi::exception('Database Problem: '.$e->getMessage());
        }

        // Returning our data-grab.
        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | get_id_from_username()
    |--------------------------------------------------------------------------
    | Receives a username in a string format and does a lookup on the DB to find
    | the id associated with that username.
    |
    | @param:     $username - the username to look up
    | @return:    integer
    */
    public static function get_id_from_username($username)
    {
        // Initialize response
        $data = false;

        // Try to get what we want
        try {
            $data = DB::connection('application_r')
                ->table('accounts')
                ->where('username', '=', $username)
                ->only('id');
        } 
        // Thow an exception if we have a DB problem 
        catch (\Exception $e) {
            ErrorApi::exception('Database Problem: '.$e->getMessage());
        }

        // Returning our data-grab.
        return $data;
    }

    /*
    |--------------------------------------------------------------------------
    | id_exists()
    |--------------------------------------------------------------------------
    | Receives an integer to look up for existence in the accounts table.
    |
    | @param:     $id - the id to look up
    | @return:    boolean
    */
    public static function id_exists($id)
    {
        // Initialize response
        $data = false;

        // Try to get what we want
        try {
            $data = DB::connection('application_r')
                ->table('accounts')
                ->find($id);
        }
        // Throw an exception if we have a DB problem
        catch (\Exception $e) {
            ErrorApi::exception('Database problem: '.$e->getMessage());
        }

        // Returning our data-grab.
        return ($data);
    }

    public static function save($input=null)
    {
        if ($input === null) {
            $input = Input::all();
        }

        try {    
            $id = DB::connection('application_w')
                ->table('accounts')
                ->insert_get_id(array(
                    'first_name' => $input['signup-first-name'],
                    'last_name' => $input['signup-last-name'],
                    'type' => $input['signup-type'],
                    'email' => $input['signup-email'],
                    'password' => Hash::make($input['signup-password']),
                ));

            Auth::login($id);

            return array(
                'success' => true,
                'code'    => 0,
                'id'      => $id,
            );

        } catch (\Laravel\Database\Exception $e) {
            return array(
                'success'  => false,
                'code'     => $e->getCode(),
                'message'  => $e->getMessage(),
            );
        }
    }
}