<?php

    require_once getenv("SRC_PATH")."/middleware/authorized.php";

    if(isset($_GET['user']))
    {
        loadPageWithValidation(getenv("SRC_PATH")."/private_pages/settings.php", $_GET['user']); 
    }
    else
    {
        echo '<div class="alert alert-danger">Access Denied.</div>';
    }

?>