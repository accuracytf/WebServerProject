<?php
$dbh = ConnectToDB();
$sql = "INSERT INTO applications (user_id, email, message) VALUES (:ui,:e,:m)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':ui', $_SESSION["user_id"]);
$stmt->bindValue(':e', $_POST["applicant_email"]);
$stmt->bindValue(':m', $_POST["applicant_message"]);
if ($stmt->execute()) {
    echo "Användaren har registrerats";
    echo '<div class="max-w-md mx-auto bg-gray-100 p-8 shadow-md rounded-md text-center">
        <h1 class="text-2xl font-semibold mb-4">Your application has been sent!</h1>
        <p class="mb-4">Thank you for applying. We will review your application and get back to you soon.</p>
        <a href="../index.php" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Go back to Home</a>
    </div>';
}


?>

