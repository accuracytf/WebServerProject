<?php
try{
    if(isset($_SESSION['user_id'])){
        $row = getUserInfo(connectToDB(), $_SESSION['user_id']);

        $profileData = array(
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'password' => $row['password'],
            'img_color' => $row['img_color']
        );
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        DeletePost($_POST['post_id']);
    }
}
catch (Exception $e){
    echo "Error: " . $e->getMessage();
}

?>

<main class="container mx-auto px-4 py-8">
    <!-- profil info -->
    <section class="profile-view bg-gray-100 shadow-md rounded-md p-6">
        <h2 class="text-xl font-semibold mb-4">View Profile</h2>
        <div class="mb-4">
            <svg width="32" height="32" viewBox="0 0 32 32" class="rounded-full">;
                <circle cx="16" cy="16" r="15" fill="<?php echo $profileData['img_color']; ?>" ></circle>
            </svg>
        </div>
        <div class="mb-4">
            <label for="Firstname" class="block font-medium mb-1">Firstname:</label>
            <p id="Firstname"><?php echo $profileData['firstname']; ?></p>
        </div>
        <div class="mb-4">
            <label for="Lastname" class="block font-medium mb-1">Lastname:</label>
            <p id="Lastname"><?php echo $profileData['lastname']; ?></p>
        </div>
        <div class="mb-4">
            <label for="viewBio" class="block font-medium mb-1">Bio:</label>
            <p id="viewBio"><?php echo $profileData['password']; ?></p>
        </div>


        <div class="mb-4">

            <a class="flex items-center" href="index.php?page=editProfile">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="w-4 h-4 mr-1.5"
                >
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
                <span class="underline">Edit Profile</span>
            </a>
        </div>
    </section>
    <br>
    <section>
        <h2 class="text-xl font-semibold mb-4">Your Posts</h2>
        <?php
        //visar dina posts
        try{

            $dbh = connectToDB();
            $stmt = getProfilePosts($dbh);
            YourPosts($stmt);
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        ?>
    </section>
</main>


