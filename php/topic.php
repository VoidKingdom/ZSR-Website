<?php
session_start();
//checks if the user got here through correct means
if (isset($_POST['topic-submit']) && (isset($_SESSION['userID']))) {
    require "dbconnect.php";
    //initilises variables
    $userid = $_SESSION['username'];
    $cid = $_POST['cat'];
    $title = $_POST['topic_title'];
    $content = $_POST['topic_content'];
    //updates all necessary datafields with new information
    $sql = "INSERT INTO topics (cat_id, topic_title, topic_author, topic_date, topic_reply) VALUES ('" . $cid . "','" . $title . "','" . $userid . "', now(), now())";
    $res = mysqli_query($connect, $sql);
    $topic_id = mysqli_insert_id($connect);
    $sql2 = "INSERT INTO posts (cat_id, topic_id, post_author, post_content, post_date) VALUES ('" . $cid . "','" . $topic_id . "','" . $userid . "','" . $content . "', now())";
    $res2 = mysqli_query($connect, $sql2);
    $sql3 = "UPDATE categories SET last_date = now(), last_user='" . $userid . "' WHERE cat_id='" . $cid . "' LIMIT 1";
    $res3 = mysqli_query($connect, $sql3);
    //checks if the data was correctly inserted and then redicts user to the newly created page
    if (($res) && ($res2) && (res3)) {
        header("Location: ../forum_topic.php?cat=" . $cid . "&topic=" . $topic_id);
    } else {
        echo "There was an error creating your topic. Please try again.";
    }
//redirrects user if they are here through alternative means
} else {
    header("Location: ../home.php");
    exit();
}

