<?php

namespace Helpers;

class Response
{

    public function __construct($data)
    {
        http_response_code(418);
        echo json_encode($data);
    }
}

class BadRequest extends Response
{
    public function __construct($data)
    {
        http_response_code(400);
        echo json_encode($data);
    }
}

class NotFound extends Response
{
    public function __construct($data)
    {
        http_response_code(404);
        echo json_encode($data);
    }
}

class Unauthorized extends Response
{
    public function __construct($data)
    {
        http_response_code(401);
        echo json_encode($data);
    }
}

class Forbidden extends Response
{
    public function __construct($data)
    {
        http_response_code(403);
        echo json_encode($data);
    }
}

class InternalServerError extends Response
{
    public function __construct($data)
    {
        http_response_code(500);
        echo json_encode($data);
    }
}

class MethodNotAllowed extends Response
{
    public function __construct($data)
    {
        http_response_code(405);
        echo json_encode($data);
    }
}

// very important
class imATeapot extends Response
{
    public function __construct($data)
    {
        http_response_code(418);
        echo json_encode($data);
    }
}