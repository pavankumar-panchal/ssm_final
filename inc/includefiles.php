<?php
if (file_exists("../functions/phpfunctions.php")) {
    include('../functions/phpfunctions.php');
} else {
    include('./functions/phpfunctions.php');
}

//if (file_exists("../inc/checksession.php")) {
//    include('../inc/checksession.php');
//} else {
//    include('./inc/checksession.php');
//}

if (file_exists("../inc/checktype.php")) {
    include('../inc/checktype.php');
} else {
    include('./inc/checktype.php');
}

if (isset($_GET['a_link']) && $_GET['a_link'] !== 'logout') {
    if (file_exists("../inc/checkprofile.php")) {
        include('../inc/checkprofile.php');
    } else {
        include('./inc/checkprofile.php');
    }
}
?>
