<form id="formLogin" action="#" method="post">
    <fieldset>
        <legend>Skapa konto</legend>
        <p>
            Förnamn <br />
            <input type="text" placeholder="Johan" name="firstname" required />
        </p>
        <p>
            Efternamn <br />
            <input type="text" placeholder="Englund" name="lastname" required />
        </p>
        <p>
            Jag är arbetsgivare?
            <input type="checkbox" name="isEmployer" checked />
        </p>
        <p>
            Lösenord <br />
            <input type="password" placeholder="Password" name="password"required />
        </p>
        <input type="submit" value="Registrera" />
    </fieldset>

    <?php
    try{
        if(isset($_POST["firstname"])){
            $dbh = connectToDB();
            if(strlen($_POST["firstname"]) > 3 && strlen($_POST["password"]) > 3){
                $sql = "INSERT INTO users (firstname, lastname, password, is_employer) VALUES (:f,:l,:p,:e)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':f', Clear($_POST["firstname"]));
                $stmt->bindValue(':l', Clear($_POST["lastname"]));
                $stmt->bindValue(':e', $_POST["isEmployer"]);
                $stmt->bindValue(':p', password_hash(Clear($_POST["password"]), PASSWORD_DEFAULT));
                if($stmt->execute()){
                    echo "Användaren har registrerats";
                }

            }


        }
    }
    catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }

    ?>
</form>