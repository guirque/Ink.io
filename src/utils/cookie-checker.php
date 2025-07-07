<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";

    /**
     * Checks if session cookie exists and is valid and returns its decoded value.
     * If it's not valid, emits an access denied alert and returns NULL.
     */
    function checkCookie()
    {
        try
        {
            if(isset($_COOKIE['session_token']))
            {
                $token = $_COOKIE['session_token'];
                $token_data = (array) JWT::decode($token, new Key(getenv("SERVER_SECRET"), "HS256"));
                
                return $token_data;
            }
            else
            {
                return NULL;
            }
        }
        catch(Exception $e)
        {
            echo '<div class="alert alert-danger alert-dismissible m-2" role="alert" style="position: fixed; z-index: 1;">
                Access Denied. Please login again.
                <button class="btn btn-close" data-bs-dismiss="alert" role="close alert">
            </div>';
            return NULL;
        }
    }



?>