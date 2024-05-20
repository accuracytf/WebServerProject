<?php
function connectToDB()
{
    //ansluter till databasen
    $dbh = new PDO(
        "mysql:host=mysql679.loopia.se;dbname=webbkodning_se_db_9;charset=utf8", "milhan@w353525", "Dragonskolan22"
    );

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $dbh;
}
function loginUser($dbh)
{
    //loggar in användaren ifall inloggnings informationen stämmer
    if (isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["lastname"])) {
        try{
            $sql = "SELECT * FROM users WHERE firstname LIKE :f AND lastname LIKE :l";
            echo "Inloggad";
            /* Förbereder förfrågan till databasen */
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':f', Sanitizer::sanitizeString($_POST["firstname"]));
            $stmt->bindValue(':l', Sanitizer::sanitizeString($_POST["lastname"]));
            $stmt->execute();
            /* Skickar förfrågan till databasen */
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify(Sanitizer::sanitizeString($_POST["password"]), Sanitizer::sanitizeString($row["password"]))) {
                $_SESSION["user_id"] = $row["user_id"];
            }
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }


    }
}
function getPosts($dbh){
    //hämtar alla posts i databasen
    $sql = "SELECT posts.*, users.firstname, users.img_color, users.lastname
            FROM posts
            INNER JOIN user_post ON posts.post_id = user_post.post_id
            INNER JOIN users ON user_post.user_id = users.user_id
            ORDER BY posts.last_date";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function getProfilePosts($dbh){
    //hämtar alla posts som den inloggade användaren har gjort
    $sql = "SELECT posts.*, users.firstname, users.img_color, users.lastname
            FROM posts
            INNER JOIN user_post ON posts.post_id = user_post.post_id
            INNER JOIN users ON user_post.user_id = users.user_id
            WHERE users.user_id = :id
            ORDER BY posts.last_date";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['user_id']);
    $stmt->execute();
    return $stmt;
}



function addPost($dbh)
{
    //skapar ett post med all info från addPost formet
    if (isset($_SESSION['user_id'])) {
        $sql = "INSERT INTO posts (`title`, `bio`, `location`, `last_date`) VALUES (:t, :b, :l, :d)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':t', Sanitizer::sanitizeString($_POST["title"]));
        $stmt->bindValue(':b', Sanitizer::sanitizeString($_POST["bio"]));
        $stmt->bindValue(':l', Sanitizer::sanitizeString($_POST["location"]));
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


function getUserInfo($dbh, $id){
    //hämtar all info om en användare
    $sql = "SELECT * FROM users WHERE user_id=:u ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getUserColor($dbh, $id){
    //hämtar en användares profilfärg
    $sql = "SELECT img_color FROM users WHERE user_id=:u ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':u', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}



function CreatePost($stmt) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //skapar ett post
        echo '<div class="rounded-lg border text-card-foreground shadow-sm bg-gray-100" data-v0-t="card">';
        echo '    <div class="p-6 grid gap-1.5 h-full">';
        echo '        <h3 class="whitespace-nowrap font-semibold tracking-tight text-base line-clamp-2">';
        echo '            <span>' . htmlspecialchars($row['title']) . '</span>';
        echo '        </h3>';
        echo '        <p class="text-sm text-muted-foreground line-clamp-4">';
        echo '            <span>' . htmlspecialchars($row['bio']) . '</span>';
        echo '        </p>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg width="32" height="32" viewBox="0 0 32 32" class="rounded-full">';
        echo '                <circle cx="16" cy="16" r="15" fill="' . htmlspecialchars($row["img_color"]) . '"></circle>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row["firstname"]) . " " . htmlspecialchars($row["lastname"]) . '</span>';
        echo '        </div>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-50">';
        echo '                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>';
        echo '                <circle cx="12" cy="10" r="3"></circle>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row['location']) . '</span>';
        echo '        </div>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-50">';
        echo '                <circle cx="12" cy="12" r="10"></circle>';
        echo '                <polyline points="12 6 12 12 16 14"></polyline>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row['last_date']) . '</span>';
        echo '        </div>';
        echo '<form method="post">';
        echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
        echo '<input class="text-blue-500 underline" type="submit" value="view details">';
        echo '</form>';
        echo '    </div>';
        echo '</div>';

    }
}

function YourPosts($stmt) {
    //visar posts i din profil
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="rounded-lg border text-card-foreground shadow-sm bg-gray-100" data-v0-t="card">';
        echo '    <div class="p-6 grid gap-1.5 h-full">';
        echo '        <h3 class="whitespace-nowrap font-semibold tracking-tight text-base line-clamp-2">';
        echo '            <span>' . htmlspecialchars($row['title']) . '</span>';
        echo '        </h3>';
        echo '        <p class="text-sm text-muted-foreground line-clamp-4">';
        echo '            <span>' . htmlspecialchars($row['bio']) . '</span>';
        echo '        </p>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg width="32" height="32" viewBox="0 0 32 32" class="rounded-full">';
        echo '                <circle cx="16" cy="16" r="15" fill="' . htmlspecialchars($row["img_color"]) . '"></circle>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row["firstname"]) . " " . htmlspecialchars($row["lastname"]) . '</span>';
        echo '        </div>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-50">';
        echo '                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>';
        echo '                <circle cx="12" cy="10" r="3"></circle>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row['location']) . '</span>';
        echo '        </div>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-50">';
        echo '                <circle cx="12" cy="12" r="10"></circle>';
        echo '                <polyline points="12 6 12 12 16 14"></polyline>';
        echo '            </svg>';
        echo '            <span>' . htmlspecialchars($row['last_date']) . '</span>';
        echo '        </div>';
        echo '        <div class="flex items-center space-x-2 text-sm">';
        echo '            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 opacity-50">';
        echo '                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>';
        echo '            </svg>';
        echo '            <span>Favorite</span>'; // Placeholder for the star icon
        echo '        </div>';
        echo '<form method="post" action="#">';
        echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
        echo '<input class="text-red-500 underline" type="submit" value="Delete">';
        echo '</form>';
        echo '    </div>';
        echo '</div>';
        echo'<br>';

    }
}

function DeletePost($id){
    //tar bort ett post
    $dbh = ConnectToDB();
    $sql = "DELETE FROM posts WHERE post_id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();
    return $success;
}

function AddUser(){
    //lägger till en användare
    $dbh = connectToDB();
    $token = $_POST['csrf'];
    if (!validateCsrfToken($token)) {
        die('Invalid CSRF token');
    }
    $_SESSION["csrf"]=generateCsrfToken();
    if (strlen($_POST["firstname"]) > 3 && strlen($_POST["password"]) > 3) {
        $sql = "INSERT INTO users (firstname, lastname, password, is_employer, img_color) VALUES (:f,:l,:p,:e,:i)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':f', Sanitizer::sanitizeString($_POST["firstname"]));
        $stmt->bindValue(':l', Sanitizer::sanitizeString($_POST["lastname"]));
        if(isset($_POST['isEmployer'])){
            $stmt->bindValue(':e', true);
        }
        else{
            $stmt->bindValue(':e', false);
        }
        $stmt->bindValue(':p', password_hash(Sanitizer::sanitizeString($_POST["password"])), PASSWORD_DEFAULT);
        $stmt->bindValue(':i', $_POST["colorPicker"]);
        if ($stmt->execute()) {
            echo "Användaren har registrerats";
        }
    }
}
?>

