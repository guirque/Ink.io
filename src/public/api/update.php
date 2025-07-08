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
            
            $db_manager->update_user_by_id($_POST['username'], $_POST['email']);

            successMsg('Account updated successfully.');
        }
        catch(Exception $e)
        {
            dangerMsg('An error occurred on account update. Please try again later.');
        }

    }
    else
    {
        emitSessionAlert();
    }

    require_once getenv("SRC_PATH")."/public/gallery.php";

?>