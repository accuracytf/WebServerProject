<?php
// Assume $profileData is an array containing profile information

$row = getUserInfo(connectToDB(), $_SESSION['user_id']);

$profileData = array(
    'firstname' => $row['firstname'],
    'lastname' => $row['lastname'],
    'password' => $row['password']
);
?>

<main class="container mx-auto px-4 py-8">
    <!-- View Profile Section -->
    <section class="profile-view bg-gray-100 shadow-md rounded-md p-6">
        <h2 class="text-xl font-semibold mb-4">View Profile</h2>
        <div class="mb-4">
            <label for="viewUsername" class="block font-medium mb-1">Username:</label>
            <p id="viewUsername"><?php echo $profileData['firstname']; ?></p>
        </div>
        <div class="mb-4">
            <label for="viewEmail" class="block font-medium mb-1">Email:</label>
            <p id="viewEmail"><?php echo $profileData['lastname']; ?></p>
        </div>
        <div class="mb-4">
            <label for="viewBio" class="block font-medium mb-1">Bio:</label>
            <p id="viewBio"><?php echo $profileData['password']; ?></p>
        </div>
        <div class="mb-4">
            <a href="index.php?page=editProfile" class="text-blue-500 hover:underline">Edit Profile</a>
        </div>
    </section>
</main>


