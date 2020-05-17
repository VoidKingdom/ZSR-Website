<?php
//This is the most important file on the website as everything uses it. Update values below for your own database login details but these are preset for my home database
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "zsr";

//Creates a command to quickly connect to the database, used on other pages
$connect = mysqli_connect($serverName, $dbUsername,$dbPassword,$dbName);
//Creates an error message when it fails to connect
if (!$connect){
    die("Connection Failed: ".mysqli_connect_error());
}
