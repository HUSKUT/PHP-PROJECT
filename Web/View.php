<?php

namespace Web;

class View
{

    public static function view($viewname, $data = null) {
        $file = __DIR__ . '/../Views/' . $viewname . '.php';

        if (file_exists($file)) {
            extract($data);
            require_once $file;
        } else {
            echo "404 :(";
        }

    }
}