<?php
//basic response
function response($code, $message = '')
{
    $data = json_encode($message, JSON_PRETTY_PRINT);

    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    header("Content-length:" . strlen($data));

    echo ($data);

    exit;
}
