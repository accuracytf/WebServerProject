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
        echo "Inloggad";
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

    $sql = "SELECT posts.*, users.firstname, users.img_src, users.lastname
            FROM posts
            INNER JOIN user_post ON posts.post_id = user_post.post_id
            INNER JOIN users ON user_post.user_id = users.user_id
            ORDER BY posts.last_date";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}



function addPost($dbh)
{
    if (isset($_SESSION['user_id'])) {
        $sql = "INSERT INTO posts (`title`, `bio`, `location`, `last_date`) VALUES (:t, :b, :l, :d)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':t', $_POST['title']);
        $stmt->bindValue(':b', $_POST['bio']);
        $stmt->bindValue(':l', $_POST['location']);
        $stmt->bindValue(':d', $_POST['last_date']);
        $stmt->execute();
        $post_id = $dbh->lastInsertId(); // Get the last inserted ID
        $sql_user_post = "INSERT INTO user_post (`user_id`, `post_id`) VALUES (:u, :p)";
        $stmt_user_post = $dbh->prepare($sql_user_post);
        $stmt_user_post->bindValue(':u', $_SESSION['user_id']);
        $stmt_user_post->bindValue(':p', $post_id);
        $stmt_user_post->execute();
    }

}
function getAllUsers($dbh){
    $sql = "SELECT user_id, username FROM users ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function getUserInfo($dbh, $id){
    $sql = "SELECT * FROM users WHERE user_id=:u ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>