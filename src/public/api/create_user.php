<?php

    # IMPORTANT REFERENCES
    # https://stackoverflow.com/questions/8922056/what-is-the-best-way-to-upload-and-store-pictures-on-the-site
    # https://stackoverflow.com/questions/8103860/move-uploaded-file-gives-failed-to-open-stream-permission-denied-error
    # https://www.w3schools.com/php/php_file_upload.asp

    # We need to give permission to move the file on /tmp/
    try
    {
        require_once "connection.php";
        require_once getenv("SRC_PATH")."/utils/emit-alert.php";
        
        $db_manager_obj = new DBManager();

        $file_path = getenv("SRC_PATH")."/".getenv("USER_PROFILE_PATH");

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
                    successMsg("Your account has been created.");
                }
    
            }
            else dangerMsg("File extension $file_extension not accepted.");

        }
        else if(!isset($_FILES) || !isset($_FILES['profile_picture']) || $_FILES['profile_picture']['size'] <= 0)
        {
            # Saving user on database
            $encrypted_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $db_manager_obj->create_user($_POST['username'], $encrypted_password, $_POST['email'], "default.png");
            successMsg("Your account has been created.");
        }
        else dangerMsg("An error occurred when trying to upload profile picture.");
    }
    catch(Exception $e)
    {
        dangerMsg('An error occurred on account creation. Please try again later.');
    }

    require_once getenv("SRC_PATH")."/public/gallery.php";

?>