<?php

include('session.php');

$error = 'Enter the following information';

// date

$data = $db -> query("SELECT name, amount FROM data
JOIN user_data ON user_data.data_id = data.id
WHERE user_id = " . $_SESSION['loginUserId'] . ";");

$names = array();
$amounts = array();

if ($data) {
    while ($row = mysqli_fetch_array($data)) {
        array_push($names, $row['name']);
        array_push($amounts, $row['amount']);
    }
}

print_r($arr);

$db -> close();

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
                            <h2>Statistics</h2>
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include('footer.php'); ?>

        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
 // Load google charts
 google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);

 // Draw the chart and set the chart values
 function drawChart() {

     //var tempArray = <?php echo json_encode($arr); ?>;
     //alert(tempArray[0].Key);

     var names = JSON.parse('<?php echo json_encode($names) ?>');
     var amounts = JSON.parse('<?php echo json_encode($amounts) ?>');
     // alert(names);
     // alert(amounts);

     //https://stackoverflow.com/questions/30690136/google-chart-api-arraytodatatable

     var graphData = [['Name', 'Cost']];

     for (var i = 0; i < amounts.length; i++) {
         graphData.push([names[i], parseInt(amounts[i])]);
     }

     console.log(graphData);

     var data = google.visualization.arrayToDataTable(
         graphData
     );

     /* var x = [
      *     ['Task', 'Hours per Day'],
      *     ['Work', 8],
      *     ['Friends', 2],
      *     ['Eat', 2],
      *     ['TV', 2],
      *     ['Gym', 2],
      *     ['Sleep', 8]
      * ];

      * console.log(x); */

     var options = {'title':'Data for ' + new Date() + '', 'width':550, 'height':400};
     var chart = new google.visualization.PieChart(document.getElementById('piechart'));
     chart.draw(data, options);

 }
</script>
