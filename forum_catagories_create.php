<?php
//This line inserts the header to the webpage
require "header.php";
//redirrect user if they do not have the required permissions
if (substr($_SESSION['userID'], 0, 1) == 1) {
    header("Location: home.php");
    exit();
}
?>
<!--This page is for the creation of a new catagory and on submission is processed through catagories.php -->
<main>
    <div class="wrapper">
        <h1>Create Catagory</h1>
        <div class="create">
            <form action="php/catagories.php" method="post">
                <input type="text" name="cat_title" placeholder="Catagory Title Here">
                <button type="submit" name="cat-submit">Create</button>
            </form>
        </div>
    </div>
</main>