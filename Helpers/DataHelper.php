<?php

namespace Helpers;

class DataHelper
{

    public static function stringify_data($data): array
    {
        foreach ($data as $key => $value) {
            $data[$key] = "'$value'";
        }

        return $data;
    }

    public static function sanitize_string(string $data): string
    {
        $sanitized_data = htmlspecialchars($data);
        $sanitized_data = trim($sanitized_data);
        $sanitized_data = stripslashes($sanitized_data);
        $sanitized_data = strip_tags($sanitized_data);
        $sanitized_data = filter_var($sanitized_data, FILTER_SANITIZE_STRING);

        return $sanitized_data;
    }
}