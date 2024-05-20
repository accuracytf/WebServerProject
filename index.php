<?php
session_start();
require_once "db.php";
include("functions.php");
if (!isset($_SESSION["csrf"])) {
    $_SESSION["csrf"] = generateCsrfToken();
}

?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8"/>
    <title>TwoPartnerTeam</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
//includerar hero om det är homepage
if(!isset($_GET["page"])){
include("components/header.php");
}
?>
<div id="wrapper">

    <section id="leftColumn">
        <nav>
            <?php include("components/navbar.php") ?>
        </nav>

    </section>

    <section id="main">
        <?php
        //pagecontroller för hela hemsidan
        $page = "start";
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        }
        switch ($page) {
            case "profile":
                include("pages/profile.php");
                break;
            case "posts":
                include("pages/posts.php");
                break;
            case "login":
                include("pages/login.php");
                break;
            case "logout":
                include("pages/logout.php");
                break;
            case "addUser":
                include("pages/addUser.php");
                break;
            case "addPost":
                include("pages/addPost.php");
                break;
            case "editProfile":
                include("pages/editProfile.php");
                break;
            default:
                include("pages/home.php");
                break;
        }
        ?>
    </section>

    <div>
        <?php include("components/footer.php"); ?>
    </div>
</div>
</body>
</html>