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
    <script>
        function showThankYouModal() {
            document.getElementById('thankYouModal').classList.remove('hidden');
        }

        function closeThankYouModal() {
            document.getElementById('thankYouModal').classList.add('hidden');
        }
    </script>
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
            case "appSent":
                include("pages/home.php");
                echo '<script>document.addEventListener("DOMContentLoaded", function() { showThankYouModal(); });</script>';
                break;
            default:
                include("pages/home.php");
                break;
        }
        ?>

    </section>
    <!-- Thank You Modal -->
    <div id="thankYouModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-md shadow-md text-center">
            <h2 class="text-2xl font-semibold mb-4">Thanks for applying!</h2>
            <p class="mb-4">We will review your application and get back to you soon.</p>
            <button onclick="closeThankYouModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Close</button>
        </div>
    </div>

    <div>
        <?php include("components/footer.php"); ?>
    </div>
</div>
</body>
</html>