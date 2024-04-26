<?php include("HeaderSession.php");
if (empty($_SESSION["checkLog"])) {
    header("location: http://localhost/Web-school/View/Login.php");
}
function userType()
{
    if ($_SESSION['user_type'] == 0) {
        return "user";
    } elseif ($_SESSION['user_type'] == 1) {
        return "admin";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/panel.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/public.css">
    <title>Document</title>
</head>

<body>
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
    </header>
    <div id="leftSide">
        <?php if (isset($_SESSION['User'])) { ?>
            <img src="<?php echo $_SESSION['imgAddrLogin']; ?>">
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
                    <?php if (checkAdmin()) { ?>
                        <th scope="col">Buttons</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION['AdminList'])) { ?>
                    <?php foreach ($_SESSION['AdminList'] as  $value) { ?>
                        </tr>
                        <th scope="row"><?php echo $value['id'] ?></th>
                        <td><?php echo $value['Name'] ?></td>
                        <td><?php echo $value['pass'] ?></td>
                        <td>
                            <?php
                            if ($value['user_type'] == 1) {
                                echo "admin";
                            } else {
                                echo "user";
                            }
                            ?></td>
                        <?php if (checkAdmin()) { ?>
                            <td>
                                <button><a class="aStyle" href="http://localhost/Web-school/View/AllFunc.php?action=edit">Edit</a></button>
                                <button><a class="aStyle" href="http://localhost/Web-school/View/AllFunc.php?action=Del">Delete</a></button>
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
                        </tr>
                    <?php } ?>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>

</html>