<?php

include('session.php');

$error = 'Delete one of the following datas:';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['selected_text'];

    $metadata = preg_split("/[ -]+/", $data);

    if ($data == '')
        $error = 'No data selected';
    else {

        $dateDelete = $db -> query("DELETE FROM data_type WHERE `name` = '" . $metadata[0] . "';");
        $linkDelete = $db -> query("DELETE FROM user_type WHERE type_name = '" . $metadata[0] . "';");
        $error = 'Deletion successful!';
    }
}

// each user needs their own types.... UGH

$data = $db -> query("SELECT data_type.name, data_type.description FROM data_type
JOIN user_type ON user_type.type_name = data_type.name
WHERE user_type.user_id = " . $_SESSION['loginUserId'] . ";");

$count = 0;
if ($data) {

    $data_type_box .= '<option selected></option>';

    while ($row = mysqli_fetch_array($data)) {
        $format = $row['name'] . ' - ' . ' < ' . $row['description'] . ' >';
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
                            <h4>Remove Type</h4><br>
                            <center><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></center>
                            <form method="post">
                                <table width="80%" cellpadding="4" cellspacing="4" border="0" align="center">
                                    <tr>
                                        <td width="60%">Data Type:&nbsp;&nbsp;&nbsp;</td>
                                        <td width="40%">
                                            <select name="dataType" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
                                                <?php echo $data_type_box ?>
                                            </select>
                                            <input type="hidden" name="selected_text" id="selected_text" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center"><br>
                                            <input name="Submit" type="submit" value="Delete Data">
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
