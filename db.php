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
function loginUser($dbh){

    if(isset($_POST["password"])&&isset($_POST["firstname"])){
        $sql = "SELECT * FROM users WHERE firstname LIKE :f";
        /* Förbereder förfrågan till databasen */
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':f', $_POST["firstname"]);
        /* Skickar förfrågan till databasen */


    }
    function getPosts($dbh){

        $sql = "SELECT * FROM posts ORDER BY last_date";
        /* Förbereder förfrågan till databasen */
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(($stmt->rowCount() == 1) && password_verify((string)$_POST["password"], $row["password"])){
            echo "Hej3";
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["lastname"] = $row["lastname"];
            header("location: ../index.php");
        }
    }
    $stmt = $dbh->prepare($sql);
    /* Skickar förfrågan till databasen */
    $stmt->execute();

    return $stmt;
}
function addPost($dbh){
    $sql = "INSERT INTO post (`from_user_id`,`to_user_id`, `text`, `date`) VALUES (:u,:id,:t,NOW())";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $_SESSION['user_id']);
    $stmt->bindValue(':t', $_POST['post']);
    $stmt->bindValue(':id', $_POST['users']);
    $stmt->execute();
}
function getAllUsers($dbh){
    $sql = "SELECT user_id, username FROM user ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}
?>