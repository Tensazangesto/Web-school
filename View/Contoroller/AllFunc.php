<?php
include("AllUsers.php");
main();
fetchData();

function main()
{

  $action = $_REQUEST['action'] ?? '';

  switch ($action) {
    case 'pan':
      Panel();
      break;
    case 'Edit':
      header("Location: http://localhost/Web-school/View/Admin/ChangePanel.php?Editorinsert=edit");
      break;
    case 'insert':
      header("Location: http://localhost/Web-school/View/Admin/ChangePanel.php?Editorinsert=insert");
      break;
    default:
      echo 0;
      break;
  }
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
    $sql = "SELECT `Name`, `pass`, `user_type`, `id`, `Rigester_date` FROM `users` WHERE 1";
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

