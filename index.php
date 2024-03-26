<?php
session_start();
require_once "db.php";
include("functions.php");
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8"/>
    <title>Sessioner</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="wrapper">
    <h1 style="font-family: 'MinOTFFont', sans-serif;">TwoPartnerGroup</h1>
    <p style="font-family: 'MinOTFFont', sans-serif;"> HEJ rtabawkjdbapownåoiOWDPOAIWdonåowa</p>
    <header>
        <?php include("components/header.php") ?>
    </header>

    <section id="leftColumn">
        <nav>
            <?php include("components/navbar.php") ?>
        </nav>
        <aside>
            <?php //include("components/aside.php") ?>
        </aside>

    </section>

    <section id="main">
        <?php
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
            default:
                break;
        }
        ?>
    </section>

    <footer>
        <?php include("components/footer.php"); ?>
    </footer>
</div>
</body>
</html>