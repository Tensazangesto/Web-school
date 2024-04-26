<?php
include("HeaderSession.php");
main();
fetchData();

function main()
{

  $action = $_REQUEST['action'] ?? '';

  switch ($action) {
    case 'logout':
      logout();
      header("location: http://localhost/Web-school/View/");
      break;
    case 'Login':
      header("location: http://localhost/Web-school/View/");
      Login();
      break;
    case 'pan':
      Panel();
      break;
    case 'Del':
      Delete();
      break;
    case 'Edit':
      Edit();
      break;
    case 'insert':
      insert();
      break;
    case 'actEdit':
      ActEdit();
      break;
    case 'actInsert':
      ActInsert();
      break;
    default:
      echo 0;
      break;
  }
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

function Edit()
{
  header("Location: http://localhost/Web-school/View/ChangePanel.php?Editorinsert=edit");
}
function insert()
{
  header("Location: http://localhost/Web-school/View/ChangePanel.php?Editorinsert=insert");
}

function Login()
{

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "shop_db";
  // Create connection
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

function Panel()
{

  if (checkAdmin() && $_SESSION["checkLog"] == true) {
    $_SESSION["User"] = "Admin";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
      echo ("Connection failed: " . mysqli_connect_error());
      return;
    }
    $sql = "SELECT `Name`, `pass`, `user_type`, `id` FROM `users` WHERE 1";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
      $_SESSION["AdminList"] = mysqli_fetch_all($res, MYSQLI_ASSOC);
    } else {
      echo "0 results";
    }
    mysqli_close($conn);

    return header("Location: http://localhost/Web-school/View/Panel.php");
  } elseif (checkAdmin() == false && $_SESSION["checkLog"] == true) {
    $_SESSION["User"] = "Standard";
    UserInfo();
    return header("Location: http://localhost/Web-school/View/Panel.php");
  }
}

function UserInfo()
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
  $sql = "SELECT * FROM `users` WHERE `Name` = '{$_SESSION["name"]}' AND `pass` = {$_SESSION["pass"]}";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) {
    $_SESSION["UserInfo"][] = mysqli_fetch_array($res, MYSQLI_ASSOC);
  } else {
    echo "0 results";
  }
  mysqli_close($conn);
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

  $sql = "UPDATE `users` SET `Name` = '$newName', `pass` = '$newPass', `user_type` = '$newUsertype', `img_addr` = '$newimg' WHERE `users`.`id` = $IDofUser";
  $res = mysqli_query($conn, $sql);
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
  $newName = mysqli_real_escape_string($conn, $_REQUEST['UserName'] ?? '');
  $newPass = mysqli_real_escape_string($conn, $_REQUEST['password'] ?? '');
  $newUsertype = mysqli_real_escape_string($conn, $_REQUEST['UserType'] ?? '');
  $newimg = mysqli_real_escape_string($conn, $_REQUEST['imgAddr'] ?? '');

  $sql = "INSERT INTO `users` (`Name`, `pass`, `user_type`, `img_addr`) VALUES ('$newName', '$newPass', '$newUsertype', '$newimg')";
  $res = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return header("Location: http://localhost/Web-school/View/Panel.php");
}
