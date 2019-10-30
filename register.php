<?php

include("session.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = 'Login with your account information';
    // username and password sent from form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $emailConfirm = mysqli_real_escape_string($db, $_POST['email-confirm']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($db, $_POST['password-confirm']);

    // Form validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error = "Invalid email format!";
    if (!filter_var($emailConfirm, FILTER_VALIDATE_EMAIL))
        $error = "Invalid email format!";
    elseif (strlen($password) < 3)
        $error = "Password must be longer than 3 characters and less than 25 characters!";
    elseif ($email == '')
        $error = "Email field is empty!";
    elseif ($emailConfirm == '')
        $error = "Confirm email field is empty!";
    elseif ($password == '')
        $error = "Password field is empty!";
    elseif ($password != $confirmPassword)
        $error = "Passwords do not match!";
    elseif (mysqli_num_rows(mysqli_query($db, "SELECT id FROM user WHERE email_address = '$email'")) == 1)
        $error = "Email already in use!";
    else {
        $pass = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db -> prepare("INSERT INTO user (email_address, password) VALUE ('$email', '$pass')");

        if($stmt -> execute()) {
            header("location: login.php");
            $error = 'Account successfully registered!';
        } else
            $error = "Something went wrong. Please try again later.";

        $stmt -> close();
        $db -> close();
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="js no-touch">
    <head>
        <title>ISC329 | Expense Tracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <?php include('head_script.php'); ?>

    </head>

    <body>
        <div id="wraper">
            <?php include('header.php'); ?>

            <section class="home-content">
                <div class="container">
                    <div class="row">
                        <?php include('nav.php'); ?>

                        <div class="col-xs-12 col-sm-7 col-lg-7 text-left" style="padding: 10px 50px 10px 50px;">
                            <h4>Register Portal</h4><br>
                            <center><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></center>
                            <form method="post">
                                <table width="80%" cellpadding="4" cellspacing="4" border="0" align="center">
                                    <tr>
											                  <td width="40%" align="right">Email Address:&nbsp;&nbsp;&nbsp;</td>
											                  <td width="20%"><input name="email" type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/></td>
										                </tr>
                                    <tr>
                                        <td width="40%" align="right">Confirm Email Address:&nbsp;&nbsp;&nbsp;</td>
											                  <td width="20%"><input name="email-confirm" type="email" value="<?php if (isset($_POST['email-confirm'])) echo $_POST['email-confirm']; ?>"/></td>
										                </tr>
                                    <tr><td><br></td><td><br></td></tr>
										                <tr>
											                  <td align="right">Password:&nbsp;&nbsp;&nbsp;</td>
											                  <td><input name="password" type="password" /></td>
										                </tr>
                                    <tr>
                                        <td align="right">Confirm Password:&nbsp;&nbsp;&nbsp;</td>
											                  <td><input name="password-confirm" type="password" /></td>
										                </tr>
										                <tr>
                                        <td>&nbsp;<br><br></td>
                                        <td colspan="3" align="center"><input name="Submit" id="Submit"  type="submit" value="Register" /></td>
										                </tr>
                                </table>
                            </form><br>
                            <p align="center"><b><font color="red">NOTICE:</font></b> If you are having trouble registering, please <a href="help.html" target="_blank">click here</a> for further assistance.</p>
                        </div>

                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>


