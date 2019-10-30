<?php
$error = 'Login using your account information.'
//$error = '<div style="color:#cc0000; margin-top:10px">Laker ID or password is invalid</div>';
?>

<!DOCTYPE html>
<html lang="en" class=" js no-touch">
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
                            <h4>About Expense Tracker</h4>
                            <p>This is an extra credit group project for ISC 329 (Database Management Systems) for SUNY Oswego Fall 2019 Semester created by Jimmy Nguyen.</p>
                            <p>The goal of this project is to further demonstrate understanding of relational databases (specifically SQL). The front end is comprised of PHP, HTML, CSS, JS (Bootstrap/JQuery), and the database being used is MySQL 8.0.14 with PHP being the backend processor as well.</p>

                            <p>Expense Tracker was an idea that came from years of wanting to do a desktop application that would track my spending habits which would help me cut down on spending. I've since given up on that idea with so many better applications being available today however it's a great database project idea as it's simple. The least time consuming part is the database. The most time consuming part is the logic required to populate queried information on the front end interface.</p>
                        </div>

                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>
