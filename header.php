<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>twisties - Road Discoverer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="/assets/icon.png">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand">
                <img class="d-inline-block" src="/assets/logo_1.png" alt="Logo" width="110px" height="55px">
                Road Discoverer
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    //page names and urls
                    $pages = array(
                        "Road Map" => "/"
                    );
                    if (isset($_SESSION['user_id'])) {
                        //add the add to map page to $pages array if the user is logged in
                        $pages["Add to Map"] = "/add-to-map/";
                        //add the my account page to $pages array if the user is logged in
                        $pages[$_SESSION["user_uid"]] = "/my-account/";
                        //add the logout page to $pages array if the user is logged in
                        $pages["Logout"] = "/account-login/includes/logout.inc.php";
                    } else {
                        //add the account login page to $pages array if the user is not logged in
                        $pages["Account"] = "/account-login/";
                    }
                    $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

                    //if each page name is the current page, add the active class to the li
                    foreach ($pages as $pageName => $pageURL) {
                        $class = ($currentPage == $pageURL) ? "active" : "";
                        echo "<li class='nav-link'><a class='nav-link $class' href='$pageURL'>$pageName</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>