<?php
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";
    require_once getenv("SRC_PATH")."/utils/cookie-checker.php";
    
    function checkCookieValidation($username=NULL)
    {
        try
        {
            $sessionToken = checkCookie();
            if(isset($sessionToken) && isset($sessionToken['username']))
            {
                if($username != NULL && $sessionToken['username'] != $username)
                {
                    return false;
                }
    
                return true;
            }
            else return false;
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
        try
        {
            if(checkCookieValidation($username))
            {
                require_once($page_link);
            }
            else require_once(getenv("SRC_PATH")."/public/login.php");
        }
        catch(Exception $e)
        {
            require_once(getenv("SRC_PATH")."/public/login.php");
        }
    }

?>