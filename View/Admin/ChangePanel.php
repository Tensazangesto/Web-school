<?php include("../Contoroller/AllUsers.php");

if (empty($_SESSION["checkLog"]) && checkAdmin() == false) {
    header("location: http://localhost/Web-school/View/Login.php");
}
$Action = $_REQUEST['Editorinsert'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/Css/change.css">
    <title>Document</title>
</head>

<body>
    <?php if ($Action == "edit") { ?>
        <form action="http://localhost/Web-school/View/Admin/Admin.php" method="get">
            <input type="text" placeholder="Id of user" name="UserID">
            <div><input type="text" placeholder="User name" name="UserName"><input type="text" placeholder="Password" name="password"></input></div>
            <div><input type="text" placeholder="User type" name="UserType"><input type="text" placeholder="image addres" name="imgAddr"></input></div>
            <input type="hidden" name="action" value="actEdit">
            <button type="submit" value="submit">Submit</button>

        </form>

    <?php } elseif ($Action == "insert") { ?>
        <form action="http://localhost/Web-school/View/Admin/Admin.php">
            <div><input type="text" placeholder="User name" name="UserName"><input type="text" placeholder="Password" name="password"></input></div>
            <div><input type="text" placeholder="User type" name="UserType"><input type="text" placeholder="image addres" name="imgAddr"></input></div>
            <input type="hidden" name="action" value="actInsert">
            <button type="submit" value="submit">Submit</button>

        </form>
    <?php } ?>
</body>

</html>