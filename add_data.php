<?php

include('session.php');

$error = 'Enter the following information';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataType = $_POST['selected_text'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $amt = $_POST['amt'];
    $date = $_POST['date'];

    if ($dataType == '')
        $error = 'Please re-select your data type';
    else if ($name == '')
        $error = 'Name is empty';
    else if ($desc == '')
        $error = 'Description is empty';
    else if ($amt == '')
        $error = 'Amount is empty';
    else if ($amt < 0)
        $error = 'Amount is not a valid number';
    else if (!(bool)strtotime($date))
        $error = 'Date is invalid';
    else {
        $dataInsert = $db -> query("INSERT INTO data (`name`, `description`, amount, data_type_name) VALUE ('" . $name . "', '" . $desc . "', " . $amt  . ", '" . $dataType . "');");

        $id = mysqli_insert_id($db);
        $date = date("Y-m-d", strtotime($date));
        $userDataInsert = $db -> query("INSERT INTO user_data (user_id, data_id, date) VALUE (" . $_SESSION['loginUserId'] . ", " . $id . ", '" . $date . "');");

        $error = 'Data successfully submitted!';
    }

}

$data_types = $db -> query("SELECT * FROM data_type JOIN user_type ON user_type.type_name = data_type.name WHERE user_id = " . $_SESSION['loginUserId'] . ";");
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
                            <h4>Add Data</h4><br>
                            <center><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></center>
                            <form method="post">
                                <table width="80%" cellpadding="4" cellspacing="4" border="0" align="center">
                                    <tr>
                                        <td width="60%">Data Type:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%">
                                            <select name="dataType" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                                                <?php echo $data_type_box ?>
                                            </select>
                                        </td>
                                        <input type="hidden" name="selected_text" id="selected_text" value="" />
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input type="button" name="addType" value="Add Type" onclick="window.location.href='add_type.php'">
                                        <input type="button" name="removeType" value="Remove Type" onclick="window.location.href='remove_type.php'"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Name:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"> <input name="name" type="text" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Description:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"><input name="desc" type="text" value="<?php if (isset($_POST['desc'])) echo $_POST['desc']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Amount (USD):&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"><input name="amt" type="number" step=".01"></td>
                                    </tr>
                                    <tr>
                                        <td width="60%">Date:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%"><input name="date" type="date"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><br>
                                            <input name="Submit" type="submit" value="Add Data">
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
