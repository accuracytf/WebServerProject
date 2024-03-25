<?php
function connectToDB()
{
    $dbh = new PDO(
        "mysql:host=mysql679.loopia.se;dbname=webbkodning_se_db_9;charset=utf8", "milhan@w353525", "Dragonskolan22"
    );

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $dbh;
}
function loginUser($dbh){

    if(isset($_POST["password"])&&isset($_POST["username"])){
        $sql = "SELECT * FROM user WHERE username LIKE :u ORDER BY username";
        /* Förbereder förfrågan till databasen */
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':u', $_POST["username"]);
        /* Skickar förfrågan till databasen */
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(($stmt->rowCount() == 1) && password_verify((string)$_POST["password"], $row["password"])){
            echo "Hej3";
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["lastname"] = $row["lastname"];
            $_SESSION["username"] = $row["username"];
            header("location: ../index.php");
        }
    }


}
function getPosts($dbh){

    $sql = "SELECT * FROM post ORDER BY date";
    /* Förbereder förfrågan till databasen */
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $_SESSION['user_id']);
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