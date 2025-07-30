<?php
    session_start();
    $nomeUsuario="";

    if (isset($_SESSION['Usuario_Session'])) {
        $IDUsuario_Sessao = $_SESSION['Usuario_Session'];
        $NomeUsuario_Sessao = $_SESSION['NomeUsuario_Session'];
        $LoginUsuario_Sessao = $_SESSION['LoginUsuario_Session'];
        $FotoUsuario_Sessao = $_SESSION['FotoUsuario_Session'];
        $FuncaoUsuario_Sessao = $_SESSION['FuncaoUsuario_Session'];
    }else{
        header('Location:index.php');
        exit();
    }
?>