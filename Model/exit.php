<?php
    session_start();
    $_SESSION['clientid'] = 0;
    header("location:../View/index.html");
?>