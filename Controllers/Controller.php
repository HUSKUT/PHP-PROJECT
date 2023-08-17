<?php

namespace Controllers;

use Web\View;
include 'Web/View.php';

class Controller
{

    public static function product(mixed $request = null) {
        if (!$request['products']) {
            echo 'all products';
            exit();
        }
        echo 'product with id ' . $request['products'];
    }

    public static function test()
    {
        return View::view('home', ['name' => 'test']);
    }
}