<?php
//checks if user got here through correct means
if (isset($_POST['signup-submit'])) {
    require 'dbconnect.php';
    //innitilises variables given through post
    $username = $_POST['sign-username'];
    $email = $_POST['sign-email'];
    $password = $_POST['sign-password'];
    $passwordRepeat = $_POST['sign-password-repeat'];

    //checks if any fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../loginsignup.php?error=signupemptyfields&username=" . $username . "&email=" . $email);
        exit();
    // checks if the email is valid
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../loginsignup.php?error=signupinvalidemail&username=" . $username);
        exit();
    //checks for proper characters in the username
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../loginsignup.php?error=signupinvalidusername&email=" . $email);
        exit();
    //checks if the passwords inputted are exactly the same
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../loginsignup.php?error=signuppasswordrepeat&username=" . $username . "&email=" . $email);
        exit();
    } else {
        //starts stmt to securely insert data
        $sql = "SELECT user_id FROM accounts WHERE username=?;";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../loginsignup.php?error=signupsqlerror");
            exit();
        } else {
            // replaces ? in the sql line with the username before checking if it is already in use
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../loginsignup.php?error=signupusernametaken&email=" . $email);
                exit();
            } else {
                //sql command to insert data with stmt
                $sql = "INSERT INTO accounts (username, email, password) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($connect);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../loginsignup.php?error=signupsqlerror");
                    exit();
                } else {
                    //encrypts the password so that it is securely stored before inserting it
                    $encryptpassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $encryptpassword );
                    mysqli_stmt_execute($stmt);
                    //redirects user with signup success prompt
                    header("Location: ../loginsignup.php?error=signup");
                    exit();
                }
            }
        }
    }
    //securely closes connection
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
//redirrects user if they are here through alternative means
} else {
    header("Location: ../loginsignup.php");
    exit();
}