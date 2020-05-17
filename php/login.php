<?php
//requires user to come through post login submission
if(isset($_POST["login-submit"])){
    //pulls variables passed through post
    require"dbconnect.php";
    $username = $_POST["log-username"];
    $password = $_POST["log-password"];
    //checks to see if any fields are empty, if so then it returns with an error message
    if (empty($username || $password)) {
        header("Location: ../loginsignup.php?error=loginemptyfields");
        exit();
    } else {
        //connects to account database through stmt for security
        $sql = "SELECT * FROM accounts WHERE username=?;";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../loginsignup.php?error=loginsqlerror");
            exit();
        } else {
            //replaces the ? with the username before inserting the querry
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            //checks if password is correct, if not then returns with error
            if($row = mysqli_fetch_assoc($results)){
                $passwordCheck = password_verify($password, $row["password"]);
                if($passwordCheck == false){
                    header("Location: ../loginsignup.php?error=loginpassword");
                    exit();
                //creates session data if login details are correct
                } else if($passwordCheck == true){
                    session_start();
                    $_SESSION["userID"] = $row["permission"].$row["user_id"];
                    $_SESSION["username"] = $row["username"];

                    header("Location: ../home.php");
                    exit();
                } else {
                    header("Location: ../loginsignup.php?error=logincodeerror");
                    exit();
                }
            } else {
                header("Location: ../loginsignup.php?error=loginnouser");
                exit();
            }
        }
    }
    //closes connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
//redirrects user if they got here through incorrect circumstances
} else {
    header("Location: ../loginsignup.php");
    exit();
}


