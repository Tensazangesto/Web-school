<?php
session_start();

function checkLog(): bool

{
    if (isset($_SESSION["checkLog"]) && $_SESSION["checkLog"] === true)
        return true;

    return false;
}
function checkAdmin(): bool
{
    if (isset($_SESSION["checkLog"]) && $_SESSION["checkLog"] === true && $_SESSION["user_type"] == 2)
        return true;

    return false;
}

function fetchData() {
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
  }
?>