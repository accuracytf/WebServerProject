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
        echo "HEJ";
        /* Förbereder f
        örfrågan till databasen */
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':f', $_POST["firstname"]);
        $stmt->execute(); // Execute the prepared statement
        /* Skickar förfrågan till databasen */
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify((string)$_POST["password"], $row["password"])) {
            $_SESSION["user_id"] = $row["user_id"];
        }

    }
}
function getPosts($dbh){

    $sql = "SELECT * FROM posts ORDER BY last_date";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}



function addPost($dbh)
{
    echo "hej22";
    if (isset($_SESSION['user_id'])) {
        echo "hej2";
        $sql = "INSERT INTO posts (`user_id`, `title`, `pay`, `last_date`) VALUES (:u,:t,:p,:d)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':u', $_SESSION['user_id']);
        $stmt->bindValue(':t', $_POST['title']);
        $stmt->bindValue(':p', $_POST['pay']);
        $stmt->bindValue(':d', $_POST['last_date']);
        $stmt->execute();
    }

}
function getAllUsers($dbh){
    $sql = "SELECT user_id, username FROM users ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function getUserInfo($dbh){
    $sql = "SELECT user_id, firstname, lastname, password FROM users WHERE user_id=:u ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $_SESSION['user_id']);
    $stmt->execute();
    return $stmt;
}
?>