<?php

if(isset($_POST["title"])){
    echo "Hej44";
    addPost(connectToDB());
}

?>
<article>
     <form method="post" action="#">
         <input type="text" name="title"/>
         <input type="text" name="pay"/>
         <input type="date" name="last_date"/>
         <input type="submit" value="addPost"/>
     </form>
</article>
