<?php
    function loggedin(){
        return isset( $_SESSION['loggedin'] );
    }

    function require_login(){
        if( !loggedin() ){
                header( 'Location: /supportsystem/test1.php?referrer='.$_SERVER['REQUEST_URI'] );
                exit;
        }
    }

?>
