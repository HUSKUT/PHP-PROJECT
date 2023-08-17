<?php

namespace Controllers;

use Helpers\Response;
use Models\User;

include 'Helpers/Response.php';

class UserController
{

    public static function index()
    {
        return new Response(User::all());
    }

    public static function show($id)
    {
        return new Response(User::find('1'));
    }

}