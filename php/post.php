<?php
session_start();
//checks if user got here through proper method and has userdata
if (isset($_POST['post_reply']) && (isset($_SESSION['userID']))) {
    //defines variables
    require "dbconnect.php";
    $userid = $_SESSION['username'];
    $email = "";
    $cid = $_POST['cat'];
    $tid = $_POST['topic'];
    $replies = $_POST['replies'];
    $content = $_POST['reply'];
    //sql queries are created and ran here to updates all other appropriate databases
    $sql = "INSERT INTO posts(cat_id, topic_id, post_author, post_content, post_date) VALUES ('".$cid."','".$tid."','".$userid."','".$content."', now())";
    $res = mysqli_query($connect,$sql);
    $sql2 = "UPDATE categories SET last_date=now(), last_user='".$userid."' WHERE cat_id='".$cid."' LIMIT 1";
    $res2 = mysqli_query($connect,$sql2);
    $sql3 = "UPDATE topics SET topic_reply=now(), topic_replies='".++$replies."', topic_last_user='".$userid."' WHERE topic_id='".$tid."' LIMIT 1";
    $res3 = mysqli_query($connect,$sql3);
    //if all are successful then it redirects the user
    if (($res) && ($res2) &&($res3)){
        header("Location: ../forum_topic.php?cat=".$cid."&topic=".$tid);
    }
//redirrects user if they are here through alternative means
} else {
    header("Location: ../home.php");
    exit();
}