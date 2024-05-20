<?php
if(isset($_SESSION['user_id'])){
    getUserInfo(connectToDB(), $_SESSION['user_id']);


echo '<main class="container mx-auto px-4 py-8">
    <section class="profile bg-white shadow-md rounded-md p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>
        <form id="profileForm" action="update_profile.php" method="post" enctype="multipart/form-data">
            <div class="mt-4 h-auto w-auto">
            <label for="colorPicker" class="block mb-1">Change profilepicture</label>
            <input class="w-12 h-[50px] rounded-full" type="color" id="colorPicker" name="colorPicker" value="#ff0000">
            <p>Selected color: <span id="colorValue">#ff0000</span></p>
        </div>
            <div class="mb-4">
                <label for="firstname" class="block font-medium mb-1">Firstname:</label>
                <input type="text" id="firstname" name="firstname" required
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="lastname" class="block font-medium mb-1">Lastname:</label>
                <input type="text" id="lastname" name="lastname" required
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <div class="mb-4">
                <label for="password" class="block font-medium mb-1">Password:</label>
                 <input type="password" id="password" name="password" required
                       class="border border-gray-300 rounded-md py-2 px-3 w-full">
            </div>
            <button type="submit" class="bg-gray-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">Save Changes</button>
        </form>
    </section>
</main>';
}
else{
    echo " you need to be logged in to accsess this page";
}
?>


