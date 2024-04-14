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
<form id="formLogout" action="#" method="post">
    <fieldset>
        <legend>Logga Ut</legend>
        <input type="submit" value="Logga ut" name="logout"/>


    </fieldset>
</form>