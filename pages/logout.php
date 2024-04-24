<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_unset();
    session_destroy();
}
?>
<form id="formLogout" action="#" method="post">
    <fieldset>
        <input type="submit" value="Logga ut" name="logout"/>
    </fieldset>
</form>