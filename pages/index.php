<?php

session_start();
if (($_SESSION ["login_status"] == 1)) {
    include 'recursos/validar_sessao.php';
    ?>
    <!DOCTYPE html>
    <html lang="pt">
    <meta charset="utf-8">
    <head>
        <?php require_once "recursos/modals.php"; ?>
        <?php require_once "recursos/header.php"; ?>
<!--        //ESTA CSS TEM QQ COISA QUE NAO ME APETECEU VER, E PORQUE DEVE FAZER FALTA A APLICACAO QUE ALTERA O MENU-->
<!--        //ALEM DISSO, REMOVI O INCLUDE DE VARIAS CSS IGUAIS QUE TINHAS NO HEADER-->
<!--        //POR ESSA RAZAO ADICIONEI A SEGUINTE CSS APENAS PARA A APP-->
        <link href="recursos/css/custom.min.css" rel="stylesheet">

        <!--<meta charset="UTF-8" />-->
    </head>
    <body class="nav-md">
   <?php
    include_once "menu.php";
    echo "<br>";
    if (empty ($_REQUEST ['pagina'])) {
        include_once "main.php";
    } else {
        include_once $_REQUEST ['pagina'] . ".php";
    }
    ?>

    </body>
    </html>

    <?php

} else {
    header('Location: login.php');
}
?>

