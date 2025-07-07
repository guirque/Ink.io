<?php


class DBManager
{
    private $connection;
    private $createUserStmt, $createDrawingStmt, $getRecentDrawingsStmt, $getUserByIdStmt, $getUserByEmailStmt;

    function __construct()
    {
        // Create connection
        try
        {
            $this->connection = new PDO('mysql:host=webdev_database;dbname='.getenv('MYSQL_DATABASE'), 'root', getenv('MYSQL_ROOT_PASSWORD'));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            echo "-> Connection Error";
        }

        // Create Statements
        $this->createUserStmt = $this->connection->prepare("INSERT INTO user (Username, Password, Profile_Picture, Email) VALUES (:username, :password, :profile_picture, :email)");        
        $this->createDrawingStmt = $this->connection->prepare("INSERT INTO drawing (Id, Author, Title, Description, Image, Published_Date) VALUES (:id, :author, :title, :description, :image, :published_Date)");
        $this->getRecentDrawingsStmt = $this->connection->prepare("SELECT TOP :num_top FROM drawing");
        $this->getUserByIdStmt = $this->connection->prepare("SELECT * FROM user WHERE Username=:username");
        $this->getUserByEmailStmt = $this->connection->prepare("SELECT * FROM user WHERE Email=:email");
    }
    
    function getConnection()
    {
        echo "getting connection...";
        return $this->connection;
    }

    function create_user($username, $password, $email, $profile_picture = NULL)
    {
        try
        {
            $this->createUserStmt->execute(array(
                ":username"=>$username,
                ":password"=>$password,
                ":profile_picture"=>$profile_picture,
                ":email"=>$email
            ));
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".$e->getMessage();
        }
    }

    function get_recent_drawings($num_drawings)
    {
        try
        {
            return $this->getRecentDrawingsStmt->execute(array(
                ":num_top"=>$num_drawings
            ));
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".e->getMessage();
        }
    }

    function get_user_by_id($username)
    {
        try
        {
            $this->getUserByIdStmt->execute(array(
                ":username"=>$username
            ));
            return $this->getUserByIdStmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".e->getMessage();
        }
    }

    function get_user_by_email($email)
    {
        try
        {
            $this->getUserByEmailStmt->execute(array(
                ":email"=>$email
            ));
            return $this->getUserByEmailStmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".e->getMessage();
        }
    }
}

?>