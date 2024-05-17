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
<section class="w-full py-12 md:py-24 lg:py-32 border-b h-screen">
    <div class="container px-4 md:px-6">
        <div class="grid gap-6 lg:grid-cols-[1fr_400px] lg:gap-12 xl:grid-cols-[1fr_600px]">
            <div class="flex flex-col justify-center space-y-4">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold tracking-tighter sm:text-5xl xl:text-6xl/none">
                        Customer Support Representative
                    </h1>
                    <p class="max-w-[600px] text-gray-500 md:text-xl dark:text-gray-400">
                        Acme Corporation is looking for a dedicated Customer Support Representative to join our team. The ideal
                        candidate will be responsible for managing customer inquiries via phone, email, and chat, providing
                        timely and accurate information while ensuring the highest level of customer satisfaction.
                    </p>
                </div>
                <div class="flex flex-col gap-2 min-[400px]:flex-row">
                    <a
                            class="inline-flex h-10 items-center justify-center rounded-md bg-gray-900 px-8 text-sm font-medium text-gray-50 shadow transition-colors hover:bg-gray-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-50 dark:text-gray-900 dark:hover:bg-gray-50/90 dark:focus-visible:ring-gray-300"
                            href="#"
                    >
                        View All Jobs
                    </a>
                    <a
                            class="inline-flex h-10 items-center justify-center rounded-md border border-gray-200 border-gray-200 bg-white px-8 text-sm font-medium shadow-sm transition-colors hover:bg-gray-100 hover:text-gray-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-gray-950 disabled:pointer-events-none disabled:opacity-50 dark:border-gray-800 dark:border-gray-800 dark:bg-gray-950 dark:hover:bg-gray-800 dark:hover:text-gray-50 dark:focus-visible:ring-gray-300"
                            href="#"
                    >
                        Apply Now
                    </a>
                </div>
            </div>
            <img
                    src="/placeholder.svg"
                    width="550"
                    height="310"
                    alt="Hero"
                    class="mx-auto aspect-video overflow-hidden rounded-xl object-cover object-center sm:w-full lg:order-last"
            />
        </div>
    </div>
</section>
<div id="wrapper">

    <section id="leftColumn">
        <nav>
            <?php include("components/navbar.php") ?>
        </nav>

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
        <?php //include("components/footer.php"); ?>
    </div>
</div>
</body>
</html>