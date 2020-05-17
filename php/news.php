<?php
session_start();
//checks if user got here through proper method and if they have correct permissions
if (isset($_POST['news-submit']) && (substr($_SESSION['userID'], 0, 1)==3)) {
    require "dbconnect.php";
    $userid = $_SESSION['username'];
    $title = $_POST['news_title'];
    $content = $_POST['news_content'];
    //inserts data into news database
    $sql = "INSERT INTO news (news_author, news_title, news_content, news_date) VALUES ('".$userid."','".$title."','".$content."',now())";
    $res = mysqli_query($connect,$sql);
    //redirects on success
    if ($res){
        header("Location: ../home.php");
    }
//redirrects user if they are here through alternative means
} else {
    header("Location: ../home.php");
    exit();
}
