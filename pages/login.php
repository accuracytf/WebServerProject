<?php
try{
    if(isset($_SESSION["user_id"])){
        echo "HEJ";
    }
    if(isset($_POST["username"])){
        loginUser(connectToDB());
    }

}
catch (Exception $e){
    echo "Error: " . $e->getMessage();
}


?>
<form id="formLogin" action="#" method="post" class="max-w-md mx-auto bg-white p-8 shadow-md rounded-md">
    <fieldset>
        <legend class="text-lg font-semibold">Konto</legend>
        <div class="mt-4">
            <label for="username" class="block mb-1">Användarnamn</label>
            <input type="text" id="username" placeholder="User123" name="firstname" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4">
            <label for="password" class="block mb-1">Lösenord</label>
            <input type="password" id="password" placeholder="Password" name="password" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        </div>
        <div class="mt-4">
            <input type="submit" value="Logga in" name="login"
                   class="w-full bg-blue-500 text-white py-2 rounded-md cursor-pointer transition duration-300 hover:bg-blue-600">
        </div>
    </fieldset>
</form>
<p class="mt-4 text-center">
    <a href="index.php?page=addUser" class="text-blue-500 hover:underline">Registrera konto</a>
</p>
