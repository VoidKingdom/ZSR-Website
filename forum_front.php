<?php
require "header.php";
?>
    <main>
        <div class="wrapper">
            <h1>ZSR Forums</h1>
            <?php
            include_once('php/dbconnect.php');
            //gets all catagories and orders them by id
            $sql = 'SELECT * FROM categories ORDER BY cat_id ASC';
            $res = mysqli_query($connect, $sql) or die(mysqli_error());
            $catagories = "";
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['cat_id'];
                    $title = $row['cat_title'];
                    //adds an anchor element to the html with the id provided by the databse
                    $catagories .= "<a href='forum_categories.php?cat=" . $id . "' class='cat_links'>" . $title . "</a>";
                }
                echo $catagories;
            }
            //if user has permission, allows user to create catagory
            if (isset($_SESSION['userID'])) {
                if (substr($_SESSION['userID'], 0, 1) > 1) {
                    echo "<a href='forum_catagories_create.php'>Create new Catagory</a>";
                }
            }
            ?>
        </div>
    </main>