<?php
include('session.php');

$record = ($db -> query("SELECT COUNT(*) AS total FROM user;")) -> fetch_array();

?>

<div class="col-xs-12 col-sm-7 col-lg-7 text-center">
    <h2>Welcome <?php echo $_SESSION['loginUserEmail']; ?></h2>
    You are user #<?php echo $_SESSION['loginUserId']; ?> registered on our website out of <?php echo $record['total'] ?> users.
</div>
