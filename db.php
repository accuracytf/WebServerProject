<?php
function connectToDB()
{
    $dbh = new PDO(
        "mysql:host=localhost;dbname=twopartnergroup;charset=utf8", "root", "admin"
    );

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $dbh;
}
function loginUser($dbh)
{

    if (isset($_POST["password"]) && isset($_POST["firstname"])) {
        $sql = "SELECT * FROM users WHERE firstname LIKE :f";
        /* Förbereder förfrågan till databasen */
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':f', $_POST["firstname"]);
        $stmt->execute(); // Execute the prepared statement
        /* Skickar förfrågan till databasen */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify((string)$_POST["password"], $row["password"])) {
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["loggedIn"] = true; // Set loggedIn session variable
            header("location: ../index.php");
            exit(); // Ensure script execution stops after redirection
        }

    }
}
    function getPosts($dbh){

        $sql = "SELECT * FROM posts ORDER BY last_date";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(($stmt->rowCount() == 1)){
            echo "Hej3";
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["lastname"] = $row["lastname"];
            header("location: ../index.php");
        }
        return $stmt;
    }



function addPost($dbh)
{
    if (isset($_SESSION['user_id'])) {
        $sql = "INSERT INTO post (`from_user_id`,`to_user_id`, `text`, `date`) VALUES (:u,:id,:t,NOW())";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':u', $_SESSION['user_id']);
        $stmt->bindValue(':t', $_POST['post']);
        $stmt->bindValue(':id', $_POST['users']);
        $stmt->execute();
    }
}
function getAllUsers($dbh){
    $sql = "SELECT user_id, username FROM user ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}
?>