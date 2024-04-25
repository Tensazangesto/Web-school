<?php
session_start();
main();
header("location: http://localhost/Web-school/View/");


function main()
{

  $action = $_REQUEST['action'];

  switch ($action) {
    case 'logout':
      logout();
      break;
    case 'Login':
      Login();
      break;
    default:
      echo 0;
      break;
  }
}





function Login()
{
  


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";
    $Uname = $_REQUEST['Username'];
    $Pass = $_REQUEST['Pass'];
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
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
      $_SESSION["user_type"] = $row['user_type'];
      echo "1 res";
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
