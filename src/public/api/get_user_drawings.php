<?php

    include_once "connection.php";

    header('Content-Type: application/json');

    try
    {
        if(isset($_GET['user']))
        {
            $user = $_GET['user'];
    
            http_response_code(200);
            $db_manager_obj = new DBManager();
            $drawings = $db_manager_obj->get_drawings_by_user($user);
    
            $res = [];
    
            foreach ($drawings as $drawing)
            {
                array_push($res, $drawing);
            }
    
            echo json_encode($res);
        }
        else
        {
            http_response_code(400);
            echo json_encode([
                "msg"=>"Bad request. Make sure to specify a user."
            ]);
        }
    }
    catch(Exception $e)
    {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }
?>