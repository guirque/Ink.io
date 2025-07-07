<?php

    require_once getenv("SRC_PATH")."/middleware/authorized.php";

    loadPageWithValidation(getenv("SRC_PATH")."/private_pages/draw.php");
?>