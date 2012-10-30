<?php

namespace Profile\Repositories;

use \Profile\Entities\Profile AS ProfileEntity;
use \Base\ErrorApi;
use \Auth;
use \DB;
use \Hash;
use \Input;

class Profile extends \Base\Repository {
    static $_id           = null;
    static $_profile_data = array(
        'first_name' => '',
        'last_name' => '',
        'email' => '',
    );

    public static function get($id)
    {
        $data = false;

        try {
            $data = DB::connection('application_r')
                ->table('accounts')
                ->where('id', '=', $id)
                ->first();
        } catch (\Exception $e) {
            die('<pre>'.print_r($e,true));
        }

        if ($data === false || is_null($data) || !count($data)) {
            ErrorApi::log('Testing exception throwing', 'InvalidArgumentException');
            //throw new \InvalidArgumentException(__CLASS__.'::'.__FUNCTION__.' testing exception throwing');
        }

        return new ProfileEntity((array)$data);
    }

public static function debug()
{
            die('<pre>'.print_r(debug_backtrace(),true).'</pre>');

}
    public static function get_profile_data($id)
    {
        $data = false;

        try {
            $data = DB::connection('application_r')
                ->table('accounts')
                ->where('id', '=', $id)
                ->first();
        } catch (\Exception $e) {
            die('<pre>'.print_r($e,true));
        }

        if ($data === false || is_null($data) || !count($data)) {
            throw new \InvalidArgumentException('testing exception throwing');
            $data = self::$_profile_data;
        }

        self::$_id = $id;
        self::$_profile_data = (array) $data;
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