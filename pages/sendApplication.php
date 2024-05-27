<?php
include "../db.php";
session_start();
$dbh = ConnectToDB();
$sql = "INSERT INTO application (post_id,user_id, email, message) VALUES (:pi,:ui,:e,:m)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':ui', $_SESSION["user_id"]);
$stmt->bindValue(':pi', $_POST["post_id"]);
$stmt->bindValue(':e', $_POST["applicant_email"]);
$stmt->bindValue(':m', $_POST["applicant_message"]);
if ($stmt->execute()) {
    echo "Användaren har registrerats";
    Header("Location: ../index.php?page=appSent");
}


?>

