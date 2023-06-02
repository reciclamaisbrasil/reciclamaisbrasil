<?php
    include_once("../../classes/conexao.php");
    include_once("../../classes/user.php");
    session_start();
    $_SESSION["User"]->logout("../login/index.php");
?>