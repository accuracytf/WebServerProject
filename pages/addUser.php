<!-- adduser html-->
<form id="formLogin" action="#" method="post" class="max-w-md mx-auto bg-white p-8 shadow-md rounded-md">
    <fieldset>
        <legend class="text-lg font-semibold">Create account</legend>
        <div class="mt-4">
            <label for="firstname" class="block mb-1">Firstname</label>
            <input type="text" id="firstname" placeholder="Firstname" name="firstname" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4">
            <label for="lastname" class="block mb-1">Lastname</label>
            <input type="text" id="lastname" placeholder="Lastname" name="lastname" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4 flex items-center">
            <input type="checkbox" id="isEmployer" name="isEmployer"
                   class="mr-2 leading-tight focus:outline-none">
            <label for="isEmployer">Are you a employer?</label>
        </div>
        <div class="mt-4">
            <label for="password" class="block mb-1">Password</label>
            <input type="password" id="password" placeholder="Password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4 h-auto w-auto">
            <label for="colorPicker" class="block mb-1">Choose a color as your profilepicture</label>
            <input class="w-12 h-[50px] rounded-full" type="color" id="colorPicker" name="colorPicker" value="#ff0000">
            <p>Selected color: <span id="colorValue">#ff0000</span></p>
        </div>

        <div class="mt-6">
            <input type="submit" value="Register"
                   class="w-full bg-gray-900 text-white py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-600">
        </div>
        <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
    </fieldset>
</form>
<script>
    //uppdaterar colorpicker värdet
    const colorPicker = document.getElementById('colorPicker');
    const colorValue = document.getElementById('colorValue');

    colorPicker.addEventListener('input', function() {
        colorValue.textContent = colorPicker.value;
    });
</script>

<?php
try {
    //lägger till en användare
    if (isset($_POST["firstname"])) {
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
            $stmt->bindValue(':p', password_hash($_POST["password"], PASSWORD_DEFAULT));
            $stmt->bindValue(':i', $_POST["colorPicker"]);
            if ($stmt->execute()) {
                echo "Användaren har registrerats";
            }
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
