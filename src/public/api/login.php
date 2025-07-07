<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";
        
    header("content-type: application/json");

    # TODO Verify if there is a session cookie set

    # Verify provided login credentials
    if(isset($_POST['username_or_email']) && isset($_POST['password']))
    {
        $identifier = $_POST['username_or_email'];
        $password = $_POST['password'];

        require_once "connection.php";

        $db_manager = new DBManager();
    
        $user = $db_manager->get_user_by_id($identifier);
        if(empty($user)) $user = $db_manager->get_user_by_email($identifier);
        
        if(empty($user))
        {
            http_response_code(404);
            echo json_encode([
                "msg"=>"User not found."
            ]);
        }
        else if(password_verify($password, $user['Password']))
        {
            # Login Successful ---------

            $expiration_date = time() + 900;

            # Setting Cookie
            $token = JWT::encode([
                "username"=>$user['Username'],
                "profile_picture"=>$user['Profile_Picture'],
                "login"=>true,
                "exp"=> $expiration_date # (https://github.com/firebase/php-jwt/issues/290)
            ], getenv("SERVER_SECRET"), "HS256");
            setcookie("session_token", $token, $expiration_date, "/");

            # Response

            http_response_code(200);
            echo json_encode([
                "msg"=>"Login successful."
            ]);
        }
        else
        {
            http_response_code(401);
            echo json_encode([
                "msg"=>"Wrong password."
            ]);
        }
    }
    else
    {
         http_response_code(400);
            echo json_encode([
                "msg"=>"Wrong request format. Make sure the request type is form compatible and the 'username_or_email' and 'password' fields are set."
            ]);
    }
?>