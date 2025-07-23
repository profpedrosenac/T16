<?php
    session_start();
    $nomeUsuario="";

    if (isset($_SESSION['Usuario_Session'])) {
        $nomeUsuario = $_SESSION['Usuario_Session'];
    }else{
        header('Location:index.php');
        exit();
    }
?>