<?php
//This line inserts the header to the webpage
require "header.php";
?>
    <main>
        <div class="wrapper">
            <h1>News Feed</h1>
            <?php
            //pulls all news from database
            include("php/dbconnect.php");
            $sql = "SELECT * FROM news ORDER BY news_date DESC;";
            $res = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $title = $row['news_title'];
                //checks if content is more than 500 characters, if it is then it compresses it to be 500 characters plus elipses
                if (strlen($row['news_content'])>500){
                    $desc = substr($row['news_content'], 0, 500)."...";
                } else {
                    $desc = substr($row['news_content']);
                }
                $html = "news_view.php?news=".$row['news_id'];
                //displays all news with short content and allows the user to be redirect to read the full thing
                echo "<div class='newssum'>
                        <h3>".$title."</h3>
                        <p>".$desc."</p>
                        <a href='".$html."'>Read More</a>
                     </div>";
                //if user has permission, allows them to be redicreted to create a news post
                if (isset($_SESSION['userID'])) {
                    if (substr($_SESSION['userID'], 0, 1) > 1) {
                        echo "<a href='news_create.php'>Create News Post</a>";
                    }
                }
            }
            ?>
        </div>
    </main>