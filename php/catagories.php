<?php
//This file purpose is to securely insert data into the categories database
session_start();
//this prevents users from accessing this page without Permission level higher than 1 or coming through the correct post submission
if (isset($_POST['cat-submit']) && substr($_SESSION['userID'], 0, 1)>1){
    require "dbconnect.php";
    //initialise variables
    $cat = $_POST['cat_title'];
    $sql = "INSERT INTO categories (cat_title) VALUES ('".$cat."')";
    $res = mysqli_query($connect,$sql);
    //redirects you to the forum page on completion
    if ($res){
        header("Location: ../forum_front.php");
    }
}else {
    //if you do not meet requirements, it redirects you to home
    header("Location: ../home.php");
    exit();
}
