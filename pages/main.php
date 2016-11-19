<?php
include_once "bd/BdMySQL.class.php";
include_once "bd/Alunos.class.php";

$rsAlunos = new Alunos();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sistema de Gestão
        <small>Painel de Controlo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Página Principal</li>
    </ol>
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>15</h3>

                    <p>Pagamentos em falta</p>
                </div>
                <div class="icon">
                    <i class="fa fa-dollar fa-1x"></i>
                </div>
                <a href="#" class="small-box-footer">Ir para <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $rsAlunos->contadorAlunos(); ?><sup style="font-size: 20px"></sup></h3>

                    <p>Aniversariantes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-birthday-cake"></i>
                </div>
                <a href="#" class="small-box-footer">Ir para <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $rsAlunos->contadorAlunos(); ?></h3>

                    <p>Alunos inscritos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="index.php?pagina=pages/alunos/gerirAlunos" class="small-box-footer">Ir para <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>435,00€</h3>

                    <p>Receitas do mês</p>
                </div>
                <div class="icon">
                    <i class="fa fa-euro"></i>
                </div>
                <a href="#" class="small-box-footer">Ir para <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

