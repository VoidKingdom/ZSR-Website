<?php
require "header.php";
?>
<main>
    <div class="wrapper">
        <?php
        include_once('php/dbconnect.php');
        $id = $_GET['news'];
        //searches for the news id from the database
        $sql = 'SELECT * FROM news WHERE news_id = "'.$id.'" LIMIT 1';
        $res = mysqli_query($connect, $sql) or die(mysqli_error());
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $date = strtotime($row['news_date']);
            echo "<h1>".$row['news_title']."</h1>";
            //displays the full content of the news post
            echo "<<div class='newssum'>
                    <p style='font-size: 18px'>".$row['news_content']."</p>
                    <p style='text-align: right'>".$row['news_author']." - ".date('d F Y', $date)."</p>
                    <a href='home.php'>Return</a>
                </div>";
        } else {
            echo '<p>News Not Found</p>';
        }
        ?>
    </div>
</main>

