<?php

    function successMsg($msg)
    {
        echo '<div class="alert alert-success alert-dismissible m-2" role="alert" style="position: fixed; z-index: 1;">
                '.$msg.'
                <button class="btn btn-close" data-bs-dismiss="alert" role="close alert">
            </div>';
    }

    function dangerMsg($msg)
    {
        echo '<div class="alert alert-danger alert-dismissible m-2" role="alert" style="position: fixed; z-index: 1;">
                '.$msg.'
                <button class="btn btn-close" data-bs-dismiss="alert" role="close alert">
            </div>';
    }
?>