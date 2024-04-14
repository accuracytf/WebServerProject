<?php
try{
    if (isset($_SESSION["user_id"]))
    {
        header("Location: ../index.php");
    }

    loginUser(connectToDB());
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
            <input type="text" placeholder="User123" name="username" required />
        </p>
        <p>
            Lösenord <br />
            <input type="password" placeholder="Password" name="password" required />
        </p>
        <input type="submit" value="Logga in" name="login"/>
        <br>
        <p>
            <a href="index.php?page=addUser"> Registrera konto </a>
        </p>

    </fieldset>
</form>