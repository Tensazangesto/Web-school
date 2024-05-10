<?php
include("../Contoroller/AllUsers.php");
$action = $_REQUEST['action'] ?? '';
if (empty($action)) {
    header("Location: http://localhost/Web-school/View/");
}
switch ($action) {
    case 'Del':
        Delete();
        break;
    case 'actEdit':
        ActEdit();
        break;
    case 'actInsert':
        ActInsert();
        break;
    default:
        echo "0";
        break;
}

function Delete()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo ("Connection failed: " . mysqli_connect_error());
        return;
    }
    $Id = $_REQUEST['id'] ?? '';
    $realID = mysqli_real_escape_string($conn, $Id);
    $sql = "DELETE FROM users WHERE `users`.`id` = $realID";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    fetchData();
    return header("Location: http://localhost/Web-school/View/Panel.php");
}

function ActEdit()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo ("Connection failed: " . mysqli_connect_error());
        return;
    }
    $IDofUser = mysqli_real_escape_string($conn, $_REQUEST['UserID'] ?? '');
    $newName = mysqli_real_escape_string($conn, $_REQUEST['UserName'] ?? '');
    $newPass = mysqli_real_escape_string($conn, $_REQUEST['password'] ?? '');
    $newUsertype = mysqli_real_escape_string($conn, $_REQUEST['UserType'] ?? '');
    $newimg = mysqli_real_escape_string($conn, $_REQUEST['imgAddr'] ?? '');

    $sql = "UPDATE `users` SET ";

    if (!empty($newName)) {
        $sql .= "`Name` = '$newName', ";
    }
    if (!empty($newPass)) {
        $sql .= "`pass` = '$newPass', ";
    }
    if (!empty($newUsertype)) {
        $sql .= "`user_type` = '$newUsertype', ";
    }
    if (!empty($newimg)) {
        $sql .= "`img_addr` = '$newimg', ";
    }

    // Remove the last comma and space
    $sql = rtrim($sql, ', ');

    $sql .= " WHERE `users`.`id` = $IDofUser";
    echo $sql;
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    return header("Location: http://localhost/Web-school/View/Panel.php");
}

function ActInsert()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $date = date("Y-m-d H:i:s");
    $newName = mysqli_real_escape_string($conn, $_REQUEST['UserName'] ?? '');
    $newPass = mysqli_real_escape_string($conn, $_REQUEST['password'] ?? '');
    $newUsertype = mysqli_real_escape_string($conn, $_REQUEST['UserType'] ?? '');
    $newimg = mysqli_real_escape_string($conn, $_REQUEST['imgAddr'] ?? '');
    $sql = "INSERT INTO `users` (`Name`, `pass`, `user_type`, `img_addr`, `Rigester_date`) VALUES ('$newName', '$newPass', '$newUsertype', '$newimg', '$date')";
    $res = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return header("Location: http://localhost/Web-school/View/Panel.php");
}
