<?php

include('session.php');

$error = 'Enter the following information';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    if (isset($_POST['dataType']))
        $dataType = $_POST['dataType'];

    if (!isset($_POST['dataType']) || $_POST['dataType'] == '')
        $error = 'Please re-select your type';
    else if ($name == '')
        $error = 'Name is empty';
    else if ($desc == '')
        $error = 'Description is empty';
    else {
        // CHECK IF NAME EXISTS
        if ($db -> query("INSERT INTO data_type (name, description, is_expense) VALUE ('" . $name . "', '" . $desc . "', " . $dataType . ");") === TRUE) {
            $dataLink = $db -> query("INSERT INTO user_type (user_id, type_name) VALUE (" . $_SESSION['loginUserId'] . ", '" .  $name . "');");
            $error = 'Data Type successfully submitted!';
        }
    }

}

$data_types = $db -> query("SELECT * FROM data_type");
$count = 0;
if ($data_types) {

    $data_type_box .= '<option selected></option>';

    while ($row = mysqli_fetch_array($data_types)) {
        $format = $row['name'];
        $data_type_box .= '<option value="' . $format . '"';
        $data_type_box .= '>' . $format;
        $data_type_box .=  '</option>';
    }
}


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

                        <div class="col-xs-12 col-sm-7 col-lg-7 text-left" style="padding: 10px 50px 10px 50px;">
                            <h4>Add Type</h4><br>
                            <center><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></center>
                            <form method="post">
                                <table width="80%" cellpadding="4" cellspacing="4" border="0" align="center">
                                    <tr>
                                        <td width="60%">Name:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"> <input name="name" type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Description:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"><input name="desc" type="text" value="<?php if (isset($_POST['desc'])) echo $_POST['desc']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Data Type:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%">
                                            <select name="dataType">
                                                <option selected></option>
                                                <option value="1">Expense</option>
                                                <option value="0">Income</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><br>
                                            <input name="Submit" type="submit" value="Add Type">
                                        </td>
										                </tr>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
            <?php include('footer.php'); ?>
        </div>
        <?php include('scripts.php'); ?>
    </body>
</html>
