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
<form id="formLogin" action="#" method="post">
    <fieldset>
        <legend>Konto</legend>
        <p>
            Användarnamn <br />
            <input type="text" placeholder="User123" name="firstname" required />
        </p>
        <p>
            Lösenord <br />
            <input type="password" placeholder="Password" name="password" required />
        </p>
        <input type="submit" value="Logga in" name="login"/>
        <br>

    </fieldset>
</form>
<p>
    <a href="index.php?page=addUser"> Registrera konto </a>
</p>