
<?php

if (isset($_SESSION['loginUserId'])) {
    $list = ' 
                    <li>
                        <a href="overview.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Overview</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="add_data.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Add Data</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./profile.htm" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Remove Data</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./profile.htm" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Statistics View</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./profile.htm" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Settings</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./logout.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Logout</h2>
                        </a>
                    </li>';
} else {
    $list = '
                    <li>
                        <a href="./index.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Home</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./login.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Login</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./register.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">Register</h2>
                        </a>
                    </li><hr>
                    <li>
                        <a href="./about.php" class="menu-li hover-animate">
                            <span class="ukie-icons hover-animate"></span>
                            <h2 class="title-header">About</h2>
                        </a>
                    </li>';
}


?>

<div class="col-xs-12 col-sm-5 col-lg-5 ">
    <nav class="menu-style4">
        <div class="container">
            <div class="row">
                <ul>
                    <?php echo $list; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
