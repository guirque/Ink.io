<?php

    include_once "connection.php";

    header('Content-Type: application/json');

    try
    {
        http_response_code(200);
        $db_manager_obj = new DBManager();
        $drawings = $db_manager_obj->get_recent_drawings();

        $res = [];

        foreach ($drawings as $drawing)
        {
            array_push($res, $drawing);
        }

        echo json_encode($res);
    }
    catch(Exception $e)
    {
        http_response_code(500);
        echo json_encode($e->getMessage());
    }
?>