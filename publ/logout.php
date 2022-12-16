<?php

require "../priv/fileload.php";

if(isset($_SESSION['email'])) {

    session_destroy();

}

header('Location: ../publ/login.php');

?>