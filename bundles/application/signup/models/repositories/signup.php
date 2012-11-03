<?php

namespace Signup\Repositories;

use \Auth;
use \DB;
use \Hash;
use \Input;

class Signup extends \Base\Repository {
    public static function save($input=null)
    {
        if ($input === null) {
            $input = Input::all();
        }

        try {    
            $id = DB::connection('application_w')
                ->table('profiles')
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
/*
    public static function save_password($input=null)
    {
        if ($input === null) {
            $input = \Input::all();
        }

        $affected = \DB::table('users')
            ->where('id', '=', $input['user-id'])
            ->update(array(
                'password' => \Hash::make($input['password-new']),
            ));

        return $affected;
    }
*/
}