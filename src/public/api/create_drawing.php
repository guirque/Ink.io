<?php

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    require_once getenv("WEB_APP_PATH")."/vendor/autoload.php";

    try
    {
        header('Content-Type: application/json');
        if(isset($_COOKIE['session_token']))
        {
            $token = $_COOKIE['session_token'];
            $token_data = (array) JWT::decode($token, new Key(getenv("SERVER_SECRET"), "HS256"));
            
            require_once "connection.php";
            
            $db_manager_obj = new DBManager();

            $file_path = "/var/www/webdev.com/src/".getenv("USER_DRAWING_PATH");

            $username = $token_data['username'];
            $d_title = $_POST['title'];
            $d_description = $_POST['description'];
            $d_drawing = $_POST['drawing_data'];

            # https://stackoverflow.com/questions/6735414/php-data-uri-to-file

            $drawing_id = uniqid().".png";

            file_put_contents($file_path.$drawing_id, file_get_contents($d_drawing));

            $db_manager_obj->create_drawing($username, $d_title, $d_description, $drawing_id);

            # Response

            http_response_code(200);
            echo json_encode([
                "msg"=>"success",
                "response"=>[$d_title, $d_description, $d_drawing]
            ]);
        }
        else
        {
            http_response_code(401);
            echo json_encode([
                "msg"=>"Unauthorized"
            ]);
        }
    }
    catch(Exception $e)
    {
        echo "An error occurred: ".$e->getMessage();
    }
?>