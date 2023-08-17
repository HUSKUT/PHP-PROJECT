<?php

namespace Models;

use database\database;

class User extends Model
{

    public String $table_name = 'users';
    public String $name;
    public int $database_id;

    public Role $role; // relationship

    public function __construct()
    {
        return $this;
    }

    public static function find(int $id): User
    {

        $db = database::getInstance();

        $data = $db->table('users')->where('id', '=', $id)->exec();

        $user = new User();

        foreach ($data[0] as $key => $value) {
            if ($key == 'id') {
                $user->database_id = $value;
                continue;
            }
            $user->$key = $value;
        }

        return $user;
    }

    public static function all(): array
    {
        $db = database::getInstance();

        $data = $db->table('users')->where('id', '>=', 0)->exec();

        $users = [];

        foreach ($data as $key => $value) {
            $user = new User();
            foreach ($value as $key => $value) {
                if ($key == 'id') {
                    $user->database_id = $value;
                    continue;
                }
                $user->$key = $value;
            }
            $users[] = $user;
        }

        return $users;
    }
}