<?php


class DBManager
{
    private $connection;
    private $createUserStmt, $createDrawingStmt, $getRecentDrawingsStmt, $getUserByIdStmt, $getUserByEmailStmt, $getDrawingsByUserStmt;

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
        $this->createDrawingStmt = $this->connection->prepare("INSERT INTO drawing (Id, Author, Title, Description, Image, Published_Date) VALUES (:id, :author, :title, :description, :image, :published_date)");
        $this->getRecentDrawingsStmt = $this->connection->prepare("SELECT d.Author, d.Title, d.Description, d.Image, d.Published_Date, u.Profile_Picture FROM drawing as d, user as u WHERE d.Author = u.Username ORDER BY d.Published_Date desc LIMIT 9");
        $this->getUserByIdStmt = $this->connection->prepare("SELECT * FROM user WHERE Username=:username");
        $this->getUserByEmailStmt = $this->connection->prepare("SELECT * FROM user WHERE Email=:email");
        $this->getDrawingsByUserStmt = $this->connection->prepare("SELECT d.Author, d.Title, d.Description, d.Image, d.Published_Date, u.Profile_Picture FROM drawing as d, user as u WHERE d.Author = u.Username AND d.Author=:username");
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

    function create_drawing($author, $title, $description, $image)
    {
        try
        {
            //(:id, :author, :title, :description, :image, :published_date)");
            $this->createDrawingStmt->execute(array(
                ":id"=>uniqid("d-"),
                ":author"=>$author,
                ":title"=>$title,
                ":description"=>$description,
                ":image"=>$image,
                ":published_date"=>date("Y-m-d H:i:s")  #https://www.uptimia.com/questions/what-is-the-correct-php-date-format-for-mysql-datetime-columns#:~:text=To%20format%20dates%20in%20PHP,that%20MySQL%20can%20store%20correctly.
            ));
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".$e->getMessage();
        }
    }

    function get_recent_drawings()
    {
        try
        {
            $this->getRecentDrawingsStmt->execute();

            $res = [];

            while($row = $this->getRecentDrawingsStmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($res, $row);
            }
            return $res;
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".$e->getMessage();
        }
    }

    function get_drawings_by_user($username)
    {
        try
        {
            $this->getDrawingsByUserStmt->execute([
                ":username"=>$username
            ]);

            $res = [];

            while($row = $this->getDrawingsByUserStmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($res, $row);
            }
            return $res;
        }
        catch(Exception $e)
        {
            echo "An error occurred: ".$e->getMessage();
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
            echo "An error occurred: ".$e->getMessage();
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
            echo "An error occurred: ".$e->getMessage();
        }
    }
}

?>