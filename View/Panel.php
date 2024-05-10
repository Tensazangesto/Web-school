<?php include("Contoroller/AllUsers.php");
fetchData();
if (empty($_SESSION["checkLog"])) {
    header("location: http://localhost/Web-school/View/Login.php");
}

function userType()
{
    if ($_SESSION['user_type'] == 1) {
        return "user";
    } elseif ($_SESSION['user_type'] == 2) {
        return "admin";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/Css/panel.css">
    <link rel="stylesheet" href="../Assets/Css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/Css/public.css">
    <title>Document</title>
</head>

<body class="bg-primary ">
    <header>
        <div id="Menu">
            <nav><a href="index.php">Home</a></nav>
            <?php
            if (empty($_SESSION["checkLog"])) {; ?>
                <nav><a href="http://localhost/Web-school/View/Login.php">Login</a></nav>
            <?php } ?>
            <?php
            if (checkLog()) { ?>
                <nav><a href="http://localhost/Web-school/View/Users/User.php?action=logout">Logout</a></nav>


                <nav><a href="http://localhost/Web-school/View/Contoroller/AllFunc.php?action=pan">Panel</a></nav>
            <?php } ?>
        </div>
    </header>
    <div id="leftSide">
        <?php if (isset($_SESSION['User'])) { ?>
            <img src="<?php echo $_SESSION['imgAddrLogin']; ?>">
        <?php } ?>
        <?php if (isset($_SESSION['User']) && checkAdmin()) { ?>
            <button class="btnStyle"><a class="aStyle" href="http://localhost/Web-school/View/Contoroller/AllFunc.php?action=Edit">Edit</a></button>
        <?php } ?>
        <?php if (isset($_SESSION['User']) && checkAdmin()) { ?>
            <button class="btnStyle"><a class="aStyle" href="http://localhost/Web-school/View/Contoroller/AllFunc.php?action=insert">Insert</a></button>
        <?php } ?>
    </div>
    <div id="rightSide">
        <table class="table">
            <thead class="thead-Dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">User type</th>
                    <th scope="col">Register date</th>
                    <?php if (checkAdmin()) { ?>
                        <th scope="col">Buttons</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php if (checkAdmin() && isset($_SESSION['AdminList'])) { ?>
                    <?php foreach ($_SESSION['AdminList'] as  $value) { ?>
                        </tr>
                        <th scope="row"><?php echo $ID = $value['id'] ?></th>
                        <td><?php echo $value['Name'] ?></td>
                        <td><?php echo $value['pass'] ?></td>
                        <td>
                            <?php
                            if ($value['user_type'] == 2) {
                                echo "admin";
                            } else {
                                echo "user";
                            }
                            ?></td>
                        <td><?php echo $value['Rigester_date'] ?></td>
                        <?php if (checkAdmin()) { ?>
                            <td>
                                <button class="btnStyleDel"><a class="aStyle" href="http://localhost/Web-school/View/Admin/Admin.php?action=Del&id=<?php echo $value['id'] ?>">Delete</a></button>
                            </td>
                        <?php } ?>
                        <tr>
                        <?php } ?>

                    <?php } elseif (isset($_SESSION['UserInfo'])) { ?>
                        <?php foreach ($_SESSION['UserInfo'] as $value) { ?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <td><?php echo $value['Name'] ?></td>
                            <td><?php echo $value['pass'] ?></td>
                            <td><?php echo userType() ?></td>
                            <td><?php echo $value['Rigester_date'] ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>

</html>