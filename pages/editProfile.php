<?php

getUserInfo(connectToDB());

echo '<main class="container mx-auto px-4 py-8">
    <section class="profile bg-white shadow-md rounded-md p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
        <form id="profileForm" action="update_profile.php" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="profilePicture" class="block font-medium mb-1">Profile Picture:</label>
                <input type="file" id="profilePicture" name="profilePicture" accept="image/*"
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="username" class="block font-medium mb-1">Username:</label>
                <input type="text" id="username" name="username" required
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="email" class="block font-medium mb-1">Email:</label>
                <input type="email" id="email" name="email" required
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="bio" class="block font-medium mb-1">Bio:</label>
                <textarea id="bio" name="bio" rows="4"
                          class="border border-gray-300 rounded-md py-2 px-3 w-full"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save Changes</button>
        </form>
    </section>
</main>';
?>


