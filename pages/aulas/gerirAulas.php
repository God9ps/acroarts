<div id="modal_editar_aula" class="modal fade" role="dialog">

<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"></h4>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">

        </div>

        <div class="modal-footer">

        </div>
    </div>

</div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Adicionar aula</b></h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row text-center" style="margin: 5px;">
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #f8f8f8">
                            <form id="form_inserir_aula" name="form_inserir_aula" method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="hidden-xs">Aula</label>
                                            <input class="form-control" id="aula" name="aula" placeholder="Aula">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Mensalidade</label>
                                            <input class="form-control" type="text" id="mensalidade" name="mensalidade" placeholder="Mensalidade">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>


            <div class="modal-footer">
                <button type="button" id="inserir_aula" class="btn btn-sm btn-primary" data-dismiss="modal">Inserir</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sistema de Gestão
        <small>Painel de Controlo</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Aulas</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row center-block">
        <div class="button_container">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nova aula</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Aulas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbl_aulas" width="100%" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th ><i class="fa fa-universal-access" aria-hidden="true"></i><span name="legenda" class="legenda"> Aula</span></th>
                            <th width="20px"><i class="fa fa-euro" aria-hidden="true"></i><span name="legenda" class="legenda"> Mensalidade</span></th>

                            <th><i class="fa fa-tasks" aria-hidden="true"></i><span name="legenda" class="legenda"> Tarefas</span></th>

                        </tr>
                        </thead>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->





