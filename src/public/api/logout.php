<?php

    try
    {
        header('Content-Type: application/json');

        # deleting cookie (https://pt.stackoverflow.com/questions/114444/como-eliminar-cookies-no-php, https://stackoverflow.com/questions/2856366/problems-deleting-cookies-wont-unset)
        setcookie('session_token', '', -1, '/');
        unset($_COOKIE['session_token']);

        http_response_code(200);
        echo json_encode([
            "msg"=>"Success."
        ]);
    }
    catch(Exception $e)
    {
        http_response_code(500);
        echo json_encode([
            "msg"=>"An error occurred."
        ]);
    }
?>