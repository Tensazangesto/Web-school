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
    if (isset($_SESSION["checkLog"]) && $_SESSION["checkLog"] === true && $_SESSION["user_type"] == 1)
        return true;

    return false;
}

?>



