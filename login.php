<?php

include('session.php');

$error = 'Login with your account information';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $row = ($db -> query("SELECT * FROM user WHERE email_address = '$email'")) -> fetch_array();

    if (password_verify($password, $row['password'])) {
        $_SESSION['loginUserId'] = $row['id'];
        $_SESSION['loginUserEmail'] = $row['email_address'];
        header("location: index.php");
    } else
    $error = '<div style="color:#cc0000; margin-top:10px">Email address or password is invalid</div>';

    $db -> close();
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
                            <h4>Login Portal</h4><br>
                            <center><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></center>
                            <form method="post">
                                <table width="80%" cellpadding="4" cellspacing="4" border="0" align="center">
                                    <tr>
                                        <td width="40%">Email Address:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="20%"> <input name="email" type="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="40%">Password:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="20%"><input name="password" type="password"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><br>
                                            <input name="Submit" type="submit" value="Login">
                                        </td>
										                </tr>
                                </table>
                            </form><br>
                            <p align="center"><b><font color="red">NOTICE:</font></b> If you are having trouble logging in, please <a href="help.html" target="_blank">click here</a> for further assistance.</p>
                        </div>

                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>
