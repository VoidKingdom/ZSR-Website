<?php
//starts session
session_start();
?>
<!--THis is the header used on all webpages so i cna change just this file to update everything page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Style sheet -->
    <link rel="stylesheet" type="text/css" href="styles/home.css">
    <meta charset="UTF-8">
</head>
<header>
    <nav>
        <!--This is the nav used on tablet and on desktop -->
        <div class="mainnav">
            <span class="open" onclick="toggleNav()">&#9776;</span>
            <a href="home.php"><img alt="" class="logo" src="images/logo.png"></a>
            <a class="navitem" href="forum_front.php">FORUM</a>
            <a class="navitem" href="https://www.speedrun.com/">LEADERBOARD</a>
            <a class="navitem" href="discord.php">DISCORD</a>
            <a class="navitem" href="schedule.php">SCHEDULE</a>
            <?php
            //adds a nav item depending on if the user is logged in or not
            if (!isset($_SESSION["userID"])) {
                echo '<a href="loginsignup.php" class="navitem">LOGIN</a>';
            } elseif (isset($_SESSION["userID"])) {
                echo "<a href='php/logout.php' class='navitem'>LOGOUT</a>";
            }
            ?>
            <span class="open" onclick="toggleNav()">&#9776;</span>
        </div>
        <!--Nav for mobile users -->
        <div class="mobilenav" id="nav">
            <a class="navitem" href="forum_front.php">FORUM</a>
            <a class="navitem" href="https://www.speedrun.com/">LEADERBOARD</a>
            <a class="navitem" href="discord.php">DISCORD</a>
            <a class="navitem" href="schedule.php">SCHEDULE</a>
            <?php
            if (!isset($_SESSION["userID"])) {
                echo '<a href="loginsignup.php" class="navitem">LOGIN / SIGNUP</a>';
            } elseif (isset($_SESSION["userID"])) {
                echo "<a href='php/logout.php' class='navitem'>LOGOUT</a>";
            }
            ?>
        </div>
        <!--js script for nav adjustments -->
        <script src="js/nav.js"></script>
    </nav>
</header>
<body>