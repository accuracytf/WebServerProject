<?php
function connectToDB()
{
    //ansluter till databasen
    $dbh = new PDO(
        "mysql:host=mysql679.loopia.se;dbname=webbkodning_se_db_9;charset=utf8mb4", "milhan@w353525", "Dragonskolan22"
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
            /* Förbereder förfrågan till databasen */
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':f', Sanitizer::sanitizeString($_POST["firstname"]));
            $stmt->bindValue(':l', Sanitizer::sanitizeString($_POST["lastname"]));
            $stmt->execute();
            /* Skickar förfrågan till databasen */
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify(Sanitizer::sanitizeString($_POST["password"]), Sanitizer::sanitizeString($row["password"]))) {
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["is_employer"] = $row["is_employer"];
                echo "Inloggad";
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

function getAppliedPosts($dbh){
    $sql = "SELECT posts.*, application.*, u1.*, user_post.*, u2.*
            FROM posts
            INNER JOIN application ON application.post_id = posts.post_id
            INNER JOIN users u1 ON u1.user_id = application.user_id
            INNER JOIN user_post ON posts.post_id = user_post.post_id
            INNER JOIN users u2 ON user_post.user_id = u2.user_id
            WHERE application.user_id = :id
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
        echo '
                <!-- Button to open the modal -->
                <div class="mt-8 text-center">
                    <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Apply for Job</button>
                </div>
                
                <!-- The Modal -->
                <div id="applyModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-8 rounded-md shadow-md w-full max-w-lg">
                        <h2 class="text-2xl font-semibold mb-4">Job Application</h2>
                        <form method="post" action="pages/sendApplication.php" class="space-y-4">
                            <div>
                                <label for="applicant_email" class="block mb-2 text-lg font-semibold text-gray-800">Email</label>
                                <input type="email" id="applicant_email" name="applicant_email" placeholder="Your Email" required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-800 placeholder-gray-400">
                            </div>
                            <div>
                                <label for="applicant_message" class="block mb-2 text-lg font-semibold text-gray-800">Message</label>
                                <textarea id="applicant_message" name="applicant_message" placeholder="Your Message" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 text-gray-800 placeholder-gray-400" rows="4"></textarea>
                            </div>
                            <div>
                                <input type="submit" value="Submit Application"
                                       class="w-full bg-gray-900 text-gray-50 py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-600">
                            </div>
                            <input type="hidden" name="post_id" value="' . $row['post_id'] . '">
                            <div class="text-right">
                                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-900">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <script>
                    function openModal() {
                        document.getElementById(\'applyModal\').classList.remove(\'hidden\');
                    }
                
                    function closeModal() {
                        document.getElementById(\'applyModal\').classList.add(\'hidden\');
                    }
                </script>
                ';
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
        echo '<form method="post" action="#">';
        echo '<input type="hidden" name="post_id" value="' . $row['post_id'] . '">';
        echo '<input class="text-red-500 underline" type="submit" value="Delete">';
        echo '</form>';
        echo '    </div>';
        echo '</div>';
        echo'<br>';

    }
}

function YourApplication($stmt) {
    //visar applications i din profil
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
    return $stmt->execute();
}

function DeleteApplication($id){
    //tar bort en application
    $dbh = ConnectToDB();
    $sql = "DELETE FROM application WHERE post_id = :id AND user_id = :ui";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':ui', $_SESSION["user_id"], PDO::PARAM_INT);
    return $stmt->execute();
}

?>

