<?php
include("HeaderSession.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../Assets/index.css">
<link rel="stylesheet" href="../Assets/public.css">
<title>Document</title>
</head>

<body id="main">
    <header>
        <div id="Menu">
            <nav><a href="index.php">Home</a></nav>
            <?php
            if (empty($_SESSION["checkLog"])) {; ?>
                <nav><a href="http://localhost/Web-school/View/Login.php">Login</a></nav>
            <?php } ?>
            <?php
            if (checkLog()) { ?>
                <nav><a href="http://localhost/Web-school/View/AllFunc.php?action=logout">Logout</a></nav>


                <nav><a href="http://localhost/Web-school/View/AllFunc.php?action=pan">Panel</a></nav>
            <?php } ?>
        </div>
        </div>
    </header>
</body>

</html>