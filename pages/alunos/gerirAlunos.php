
<div id="modal_editar_aluno" class="modal fade" role="dialog">

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

<div id="confirm" class="modal fade" role="dialog">

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
                <h4 class="modal-title"><b>Adicionar aluno</b></h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row text-center" style="margin: 5px;">
                    <div class="panel panel-default">
                        <div class="panel-body" style="background-color: #f8f8f8">
                            <form id="form_editar_aluno" name="form_editar_aluno" method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="hidden-xs">Nome</label>
                                            <input class="form-control" id="nome" name="nome" placeholder="Nome">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Morada</label>
                                            <input class="form-control" type="text" id="morada" name="morada" placeholder="Morada">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Cod. Postal</label>
                                            <input class="form-control" type="text" id="cod_postal" name="cod_postal" placeholder="Código Postal">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Localidade</label>
                                            <input class="form-control" type="text" id="localidade" name="localidade" placeholder="Localidade">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Telefone</label>
                                            <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Telefone">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">E-Mail</label>
                                            <input class="form-control" type="email" id="mail" name="mail" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Pai</label>
                                            <input class="form-control" type="text" id="pai" name="pai" placeholder="Pai">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Mãe</label>
                                            <input class="form-control" type="text" id="mae" name="mae" placeholder="Mãe">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">E-Mail de contacto</label>
                                            <input class="form-control" type="mail_contacto" id="email" name="mail_contacto" placeholder="Email de contacto">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Data de Nascimento</label>
                                            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-3">
                                        <div class="form-group">
                                            <label class="hidden-xs">Foto</label>
                                            <input class="form-control" type="file" id="foto" name="foto" placeholder="Foto" >
                                            <span><small>Para uma melhor visualização a imagem deverá ter um ratio de 1:1</small></span>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>


            <div class="modal-footer">
                <button type="button" id="inserir_aluno" class="btn btn-sm btn-primary" data-dismiss="modal">Inserir</button>
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
        <li class="active">Alunos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row center-block">
        <div class="button_container">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo aluno</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listagem de alunos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbl_alunos" width="100%" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th width="20px"><i class="fa fa-file-image-o" aria-hidden="true"></i></th>
                            <th><i class="fa fa-user" aria-hidden="true"></i><span name="legenda" class="legenda"> Nome</span></th>
                            <th><i class="fa fa-mobile-phone" aria-hidden="true"><span name="legenda" class="legenda"> Telemovel</span></i></th>
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





