<?php
require "header.php";

?>
    <main>
        <div class="lswrapper">
            <div>
                <h1>Log In</h1>
                <?php
                //checks if any errors were passed and displays message if there is
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "loginemptyfields") {
                        echo '<p class="signuperror">Not all fields are filled in.</p>';
                    } elseif ($_GET["error"] == "loginsqlerror") {
                        echo '<p class="signuperror">Issue with the SQL server</p>';
                    } elseif ($_GET["error"] == "loginpassword") {
                        echo '<p class="signuperror">Incorrect Password</p>';
                    } elseif ($_GET["error"] == "logincodeerror") {
                        echo '<p class="signuperror">Fayaz did an oopsie</p>';
                    } elseif ($_GET["error"] == "loginnouser") {
                        echo '<p class="signuperror">Username not recognised</p>';
                    }
                }
                ?>
                <!--form for login -->
                <form action="php/login.php" method="post">
                    <p>Username</p>
                    <input type="text" name="log-username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="log-password" placeholder="Enter Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
            </div>
            <div>
                <h1>Signup</h1>
                <?php
                //checks if any errors were passed and displays message if there is
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "signupemptyfields") {
                        echo '<p class="signuperror">Fill in all fields!</p>';
                    } elseif ($_GET["error"] == "signupinvalidemail") {
                        echo '<p class="signuperror">Re-input a valid email adress</p>';
                    } elseif ($_GET["error"] == "signupinvalidusername") {
                        echo '<p class="signuperror">Make sure your username only contains letters and numbers</p>';
                    } elseif ($_GET["error"] == "signuppasswordrepeat") {
                        echo '<p class="signuperror">Your passwords do not match. Please reinput your passwords</p>';
                    } elseif ($_GET["error"] == "signupsqlerror") {
                        echo '<p class="signuperror">Sql Database error</p>';
                    } elseif ($_GET["error"] == "signupusernametaken") {
                        echo '<p class="signuperror">Username is taken, please use another username</p>';
                    }
                } else if (isset($_GET["signup"])) {
                    if ($_GET["signup"] == "success") {
                        echo '<p class="signupsuccess">Signup successful!</p>';
                    }
                }
                ?>
                <!--form for signup -->
                <form action="php/signup.php" method="post">
                    <p>Username</p>
                    <?php
                    if (!empty($_GET["uid"])) {
                        echo '<input type="text" name="sign-username" placeholder="Username" value="' . $_GET["username"] . '">';
                    } else {
                        echo '<input type="text" name="sign-username" placeholder="Username">';
                    }
                    echo "<p>Email</p>";
                    if (!empty($_GET["mail"])) {
                        echo '<input type="text" name="sign-email" placeholder="E-mail" value="' . $_GET["email"] . '">';
                    } else {
                        echo '<input type="text" name="sign-email" placeholder="E-mail">';
                    }
                    ?>
                    <p>Password</p>
                    <input type="password" name="sign-password" placeholder="Password">
                    <p>Repeat Password</p>
                    <input type="password" name="sign-password-repeat" placeholder="Password">
                    <button type="submit" name="signup-submit">Signup</button>
                </form>
            </div>
        </div>
    </main>