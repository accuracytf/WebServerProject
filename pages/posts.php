<section>
    <article id="articleLeft">
        <h3>Inlägg</h3>
        <?php
        if(isset($_SESSION["loggedIn"])){
            try{
                $dbh = connectToDB();
                $stmt = getPosts($dbh);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<article class='box'>" ;
                    echo $row["title"]. "<br>";
                    echo $row["pay"]. "<br>";
                    echo $row["date"];
                    echo "</article>";
                }
            }
            catch(Exception $e){
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
    </article>

    <a href="index.php?page=addPost">Hej<a/>

</section>