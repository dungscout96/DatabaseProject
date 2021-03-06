<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    /*
     * login.php
     * Login form
     * Allows user to log in or create account if they don't have one.
     * Users can also request a password reset in case they forget their password.
     */
    ?>
    <meta charset="utf-8">
    <title>Log in | Rate my Professor</title>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <?php
    include_once('db_connect.php');
    include_once('links.html');
    include('nav.php');
    
    if (array_key_exists('login_failed', $_SESSION)) {
        $loginFailed = true;
        unset($_SESSION['login_failed']);
    } else {
        $loginFailed = false;
    }
    ?>
</head>

<body style="background: url('img/pattern.png');">

<div class="container">

    <form class="form-signin" method="POST" action="login-auth.php">
        <?php
        if ($loginFailed) {
            printf("<div class='alert alert-danger'> <strong>Login Failed !</strong> Username and Password you provided do not match.<br> Please try again.</div>");
        }
        if (array_key_exists('signup_success', $_SESSION)) {
            unset($_SESSION['signup_success']);
            printf("<div class='alert alert-success'> <strong>Sign up Successful !</strong> You have successfully signed up." .
                " Please use your username and password to log in.</div>");
        }
        if (array_key_exists('reset_success', $_SESSION)) {
            unset($_SESSION['reset_success']);
            printf("<div class='alert alert-success'> <strong>Password Reset Email sent ! <br></strong>An email with the instruction to reset" .
                " your password has been sent to the email address associated with your account. Please follow the instruction in the email.</div>");
        }
        if (array_key_exists('pass_change_success', $_SESSION)) {
            unset($_SESSION['pass_change_success']);
            printf("<div class='alert alert-success'> <strong>Password Successfully Changed ! <br></strong>Please log in using the form below:</div>");
        }

        // Test redirect from $_GET
        echo '<input type="hidden" name="location" value="';
        if(isset($_GET['location'])) {
            echo htmlspecialchars($_GET['location']);
        }
        if(isset($_GET['id'])) {
            echo "?id=" . htmlspecialchars($_GET['id']);
        }
        echo '">';
        //  Will show something like this:
        //  <input type="hidden" name="location" value="course-review.php?id=1" />
        /**************************************************/
        ?>

        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="username" name='username' class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <?php
            printf("<p align='center'><a href='signup.php");
            if(isset($_GET['location'])) {
                echo "?location=" . urlencode($_GET['location']);
            }
            if(isset($_GET['id'])) {
                echo "&id=" . urlencode($_GET['id']) . "'";
            }
        printf("'>Register</a> - <a href='password-reset.php'>Forgot Password</a></p>");
        ?>
    </form>

</div> <!-- /container -->

</body>
</html>
