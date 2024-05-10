<?php
include("../Contoroller/AllUsers.php");



$action = $_REQUEST['action'] ?? '';

if (empty($action)) {
    header("Location: http://localhost/Web-school/View/");
}
switch ($action) {
    case 'Login':
        Login();
        header("Location: http://localhost/Web-school/View/");
        break;
    case 'logout':
        logout();
        header("Location: http://localhost/Web-school/View/");
    default:
        header("Location: http://localhost/Web-school/View/");
        break;
}


function Login()
{

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $Uname = mysqli_real_escape_string($conn, $_REQUEST['Username'] ?? "");
    $Pass = mysqli_real_escape_string($conn, $_REQUEST['Pass'] ?? "");
    // Check connection
    if (!$conn) {
        echo ("Connection failed: " . mysqli_connect_error());
        return;
    }

    $sql = "SELECT * FROM `users` WHERE `Name` = '$Uname' AND `pass` = '$Pass'";
    // $sql = "INSERT INTO `users` (`Name`, `pass`, `img_addr`, `img_name`, `id`) VALUES ('bay', '321', 'gdgf', 'you', NULL)";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION["checkLog"] = true;
        $_SESSION["name"] = $row['Name'];
        $_SESSION["pass"] = $row['pass'];
        $_SESSION["user_type"] = $row['user_type'];
        $_SESSION["imgAddrLogin"] = $row['img_addr'];
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
}


function logout()
{
    session_unset();
    session_destroy();
}
