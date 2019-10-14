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
                        <?php
                        if (true) {
                            include('nav_default.php');
                            include('splash_page.php');
                        } else {
                            include('nav.php');
                            include('welcome_page.php');
                        }
                        ?>
                    </div>
                </div>
            </section>

            <?php include('footer.php'); ?>

        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>
