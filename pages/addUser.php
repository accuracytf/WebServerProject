<form id="formLogin" action="#" method="post" class="max-w-md mx-auto bg-white p-8 shadow-md rounded-md">
    <fieldset>
        <legend class="text-lg font-semibold">Skapa konto</legend>
        <div class="mt-4">
            <label for="firstname" class="block mb-1">Förnamn</label>
            <input type="text" id="firstname" placeholder="Johan" name="firstname" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4">
            <label for="lastname" class="block mb-1">Efternamn</label>
            <input type="text" id="lastname" placeholder="Englund" name="lastname" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4 flex items-center">
            <input type="checkbox" id="isEmployer" name="isEmployer" checked
                   class="mr-2 leading-tight focus:outline-none">
            <label for="isEmployer">Jag är arbetsgivare?</label>
        </div>
        <div class="mt-4">
            <label for="password" class="block mb-1">Lösenord</label>
            <input type="password" id="password" placeholder="Password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4">
            <label for="img" class="block mb-1">Profilbild</label>
            <input type="text" id="img" placeholder="img" name="img" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-6">
            <input type="submit" value="Registrera"
                   class="w-full bg-blue-500 text-white py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-600">
        </div>
    </fieldset>
</form>

<?php
try {
    if (isset($_POST["firstname"])) {
        $dbh = connectToDB();
        if (strlen($_POST["firstname"]) > 3 && strlen($_POST["password"]) > 3) {
            $sql = "INSERT INTO users (firstname, lastname, password, is_employer, img_src) VALUES (:f,:l,:p,:e,:i)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':f', Clear($_POST["firstname"]));
            $stmt->bindValue(':l', Clear($_POST["lastname"]));
            $stmt->bindValue(':e', $_POST["isEmployer"]);
            $stmt->bindValue(':p', password_hash(Clear($_POST["password"]), PASSWORD_DEFAULT));
            $stmt->bindValue(':i', $_POST["img"]);
            if ($stmt->execute()) {
                echo "Användaren har registrerats";
            }
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
