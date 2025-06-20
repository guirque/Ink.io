<?php

    /*
        References
        - https://www.php.net/manual/en/pdo.connections.php
        - https://www.php.net/manual/en/pdo.prepared-statements.php
        - https://www.php.net/manual/en/function.getenv.php
    */

    try
    {
        # Establishing Connection
        $connection = new PDO('mysql:host=webdev_database;dbname='.getenv('MYSQL_DATABASE'), 'root', getenv('MYSQL_ROOT_PASSWORD'));
        echo "Done!";

        echo "<h2>Inserting a user...</h2>";
        $id_to_insert = null;
        $address_to_insert = null;

        $insert_user_stmt = $connection->prepare("INSERT INTO user (id, address) VALUES (:id, :address)");
        $insert_user_stmt->bindParam(':id', $id_to_insert);
        $insert_user_stmt->bindParam(':address', $address_to_insert);

        $id_to_insert = 54;
        $address_to_insert = "Rua Lorem Ipsum";
        #$insert_user_stmt->execute();

        echo "Done!";

        echo "<h2>Fetching a user...</h2>";
        $id_to_fetch = null;

        $fetch_user_stmt = $connection->prepare("SELECT * FROM user WHERE id=:id");
        $fetch_user_stmt->bindParam(':id', $id_to_fetch);

        $id_to_fetch = 54;
        $fetch_user_stmt->execute();

        foreach ($fetch_user_stmt as $row)
        {
            echo "<h3>{$row['ID']}, {$row['ADDRESS']}</h3>";
        }

        echo "Done!";

        # Closing Connection
        $connection = null;
    }
    catch(PSDOException $e)
    {
        echo $e->getMessage();
        echo "-> Connection Error";
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        echo "-> Error";
    }
?>