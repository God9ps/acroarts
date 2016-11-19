<?php
include_once '../../bd/BdMySQL.class.php';
include_once '../../bd/Alunos.class.php';

$rsAluno = new Alunos();

$id = $_POST['id'];

$resultado = $rsAluno->capturarAlunoPeloId($id);

extract($resultado);
?>
<div class="row text-center" style="margin: 5px;">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #f8f8f8">
            <form id="form_editar_aluno" name="form_editar_aluno" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="hidden-xs">Nome</label>
                            <input class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Morada</label>
                            <input class="form-control" type="text" id="morada" name="morada" placeholder="Morada" value="<?php echo $morada; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Cod. Postal</label>
                            <input class="form-control" type="text" id="cod_postal" name="cod_postal" placeholder="Código Postal" value="<?php echo $cod_postal; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Localidade</label>
                            <input class="form-control" type="text" id="localidade" name="localidade" placeholder="Localidade" value="<?php echo $localidade; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Telefone</label>
                            <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Telefone" value="<?php echo $telefone; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">E-Mail</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Email" value="<?php echo $mail; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Pai</label>
                            <input class="form-control" type="text" id="pai" name="pai" placeholder="Pai" value="<?php echo $pai; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Mãe</label>
                            <input class="form-control" type="text" id="mae" name="mae" placeholder="Mãe" value="<?php echo $mae; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">E-Mail de contacto</label>
                            <input class="form-control" type="mail_contacto" id="email" name="mail_contacto" placeholder="Email de contacto" value="<?php echo $mail_contacto; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Data de Nascimento</label>
                            <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento" value="<?php echo $data_nascimento; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Foto</label>
                            <input class="form-control" type="file" id="foto" name="foto" placeholder="Foto" value="<?php echo $foto; ?>">
                            <span><small>Para uma melhor visualização a imagem deverá ter um ratio de 1:1</small></span>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>