<?php
//deletes session data and redirects user to homepage
session_start();
session_unset();
session_destroy();
header("Location: ../home.php");