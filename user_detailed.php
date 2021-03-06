<?php
require_once 'bootstrap.php';
require_once './api/authenticationUtilities.php';
$neededPermissions = array('promote');
evaluateSessionPermissions($neededPermissions);
?>
<!doctype html>
<html dir="ltr" lang="en" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <title>User</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="user_detailed.js"></script>

</head>
<body onload="displayUser(getParameter(document.location.search).Username); setUserID(); setDeleteParameters();">

    <div id="loadingUser">
        <span>Loading User</span><br>
        <img src='ajax-loader.gif' alt='loading' />
    </div>

    <div id="user" style="display: none; /*Jquery deals with showing the element after everything is loaded */">

        <div class="userTitle">
            <strong>User</strong>
        </div>

        <header id="userHeader">
            <ul class="userInfo">
                <li>Username: <span id="Username"></span></li>
            </ul>
        </header>

        <section id="userDetail">
            <ul class="userDetail">
                <li>Name:
                    <p id="Name"></p>
                </li>

                <li>Email address:
                    <p id="emailAddress"></p>
                </li>

                <li>Permission level:
                    <p id="PermissionType"></p>
                </li>
            </ul>
        </section>

        <?php
        if(comparePermissions(array('promote'))) {
            echo '<div id="editButtons">';
                echo '<form id="edit" method="get" action="./user_form.php">';
                    echo '<input id="UsernameInput" type="text" name="UsernameInput" style="display: none;">';
                    echo '<input type="submit" value="Edit">';
                echo '</form>';

                echo '<form id="delete" method="get" action="./api/deleteFrom.php" onsubmit="return confirm(\'Confirm deletion?\')">';
                    echo '<input id="tableDel" type="text" name="table" style="display: none;">';
                    echo '<input id="fieldDel" type="text" name="field" style="display: none;">';
                    echo '<input id="valueDel" type="text" name="value" style="display: none;">';
                    echo '<input type="submit" value="Delete">';
                echo '</form>';
            echo '</div>';
        }
        ?>
    </div>

</body>

</html>