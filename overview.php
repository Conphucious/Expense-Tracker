<?php

include('session.php');

$id = $_SESSION['loginUserId'];


$incomeC = ($db -> query("
SELECT COUNT(*) AS total FROM user_data
JOIN data ON data.id = user_data.data_id
JOIN data_type ON data_type.name = data.data_type_name
WHERE user_data.user_id = " . $id . " AND data_type.is_expense = 0;")) -> fetch_array();

$expenseC = ($db -> query("
SELECT COUNT(*) AS total FROM user_data
JOIN data ON data.id = user_data.data_id
JOIN data_type ON data_type.name = data.data_type_name
WHERE user_data.user_id = " . $id . " AND data_type.is_expense = 1;")) -> fetch_array();

$budgetC = ($db -> query("SELECT COUNT(*) AS total FROM user_budget WHERE user_id = " . $id . ";")) -> fetch_array();

$expenseS = ($db -> query("
SELECT SUM(data.amount) AS total FROM user_data
JOIN data ON data.id = user_data.data_id
JOIN data_type ON data_type.name = data.data_type_name
WHERE data_type.is_expense = 1 AND user_data.user_id = " . $id . ";")) -> fetch_array();

$incomeS = ($db -> query("
SELECT SUM(data.amount) AS total FROM user_data
JOIN data ON data.id = user_data.data_id
JOIN data_type ON data_type.name = data.data_type_name
WHERE data_type.is_expense = 0 AND user_data.user_id = " . $id . ";")) -> fetch_array();

if ($expenseS['total'] == null)
    $expenseS['total'] = 0;
if ($incomeS['total'] == null)
    $incomeS['total'] = 0;

// // total per this data type: need for loop

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
                        <div class="col-xs-12 col-sm-7 col-lg-7 text-center">
                            <h2><u>Overview</u></h2>
                        </div>

                        <div class="col-xs-12 col-sm-7 col-lg-7 text-left">
                            <ul>
                                <li>Expenses submitted: <?php echo $expenseC['total']; ?> </li>
                                <li>Total expenses:  <?php echo "$" . $expenseS['total']; ?> </li>
                                <li>Income submitted: <?php echo $incomeC['total']; ?> </li>
                                <li>Total income: <?php echo "$" . $incomeS['total']; ?> </li>
                                <li>Goal Budgets submitted: <?php echo "$" . $budgetC['total']; ?></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </section>

            <?php include('footer.php'); ?>

        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>
