<?php

$db = new mysqli("127.0.0.1", "root", "", "isc329");

if ($db -> connect_error)
    die("Connection failed: " . $db -> connect_error);

?>
