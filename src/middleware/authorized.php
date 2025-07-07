<?php
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";
    
    function checkCookieValidation($username=NULL)
    {
        try
        {
            if(isset($_COOKIE['session_token']))
            {
                $token = $_COOKIE['session_token'];
                $token_data = JWT::decode($token, new Key(getenv("SERVER_SECRET"), "HS256"));
                
                if($username != NULL && $token_data['username'] != $username)
                {
                    return false;
                }
    
                return true;
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    /**
     * Validates cookies for page access.
     * If the page is accessed without a valid session_token, load a login page instead.
     * If it is accessed correctly, load the content desired.
     * 
     * NULL username means the user must be identified, but their identity does not matter.
     */
    function loadPageWithValidation($page_link, $username=NULL)
    {
        if(checkCookieValidation($username))
        {
            require_once($page_link);
        }
        else require_once(getenv("SRC_PATH")."/public/login.php");
    }

?>