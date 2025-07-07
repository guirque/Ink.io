<?php

    # IMPORTANT REFERENCES
    # https://stackoverflow.com/questions/8922056/what-is-the-best-way-to-upload-and-store-pictures-on-the-site
    # https://stackoverflow.com/questions/8103860/move-uploaded-file-gives-failed-to-open-stream-permission-denied-error
    # https://www.w3schools.com/php/php_file_upload.asp

    # We need to give permission to move the file on /tmp/
    try
    {
        require_once "connection.php";
        
        $db_manager_obj = new DBManager();

        echo "<br>";

        $file_path = "/var/www/webdev.com/src/".getenv("USER_PROFILE_PATH");

        # Uploading Photo --------------------------------------------------------
        # If temporary file exists
        if(
            isset($_FILES['profile_picture']) && file_exists($_FILES['profile_picture']['tmp_name'])
            && $_FILES['profile_picture']['size'] < getenv("MAX_IMAGE_SIZE") # If file is of acceptable size
        )
        {
            $split_type = explode('/', $_FILES['profile_picture']['type']);
            $file_extension = ".".$split_type[count($split_type)-1];
            $ACCEPTED_FILE_TYPES = array('.png', '.jpg', '.jpeg');
            
            # Checking file extension
            if(in_array($file_extension, $ACCEPTED_FILE_TYPES))
            {
                # Analyzing file
                
                $file_name = uniqid('', true).$file_extension;
                # Uploading file to photos folder
                if(!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $file_path.$file_name))
                {
                    echo "<h1>An error occurred when trying to save image.</h1>";
                }
                else
                {
                    # Saving user on database
                    $encrypted_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $db_manager_obj->create_user($_POST['username'], $encrypted_password, $_POST['email'], $file_name);
                    echo "<h1>User creation operation finished.</h1>";
                    # echo "<hr><img src=\"http://webdev.com/photos/user_profile/$file_name\" alt=\"user photo\" width=\"400\"/><hr>";
                }
    
            }
            else echo "<h1>File extension $file_extension not accepted.</h1>";

        }
        else echo "<h1>An error occurred when trying to upload profile picture.</h1>";

    }
    catch(Exception $e)
    {
        echo "An error occurred: ".$e->getMessage();
    }

?>