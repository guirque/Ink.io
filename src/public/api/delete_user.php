<?php

    require_once getenv("SRC_PATH")."/middleware/authorized.php";
    require_once getenv("SRC_PATH")."/utils/emit-alert.php";

    $token = checkCookie();
    if(isset($token) && isset($token['username']) && 
    isset($_POST['username']) && $token['username'] == $_POST['username'])
    {
        try
        {

            require_once "connection.php";
            $db_manager = new DBManager();

            # deleting photos from memory ----

            # drawings
            $drawings = $db_manager->get_drawings_by_user($_POST['username']);
            foreach ($drawings as $drawing)
            {
                unlink(getenv("SRC_PATH")."/public/photos/user_drawing/".$drawing['Image']);
            }

            # profile photo
            $user_photo = $db_manager->get_user_by_id($_POST['username'])['Profile_Picture'];
            if(strcmp($user_photo, "default.png") == -1)
                unlink(getenv("SRC_PATH")."/public/photos/user_profile/".$user_photo);
            
            # deleting user
            $db_manager->delete_user_by_id($_POST['username']);

            # deleting cookie (https://pt.stackoverflow.com/questions/114444/como-eliminar-cookies-no-php, https://stackoverflow.com/questions/2856366/problems-deleting-cookies-wont-unset)
            setcookie('session_token', '', -1, '/');
            unset($_COOKIE['session_token']);

            successMsg('Account deleted successfully.');
        }
        catch(Exception $e)
        {
            dangerMsg('An error occurred on account deletion. Please try again later.');
        }

    }
    else
    {
        emitSessionAlert();
    }

    require_once getenv("SRC_PATH")."/public/gallery.php";

?>