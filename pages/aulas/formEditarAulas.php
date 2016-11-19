<?php
include_once '../../bd/BdMySQL.class.php';
include_once '../../bd/Aulas.class.php';

$rsAulas = new Aulas();

$id = $_POST['id'];

$resultado = $rsAulas->capturarAulaPeloId($id);

extract($resultado);
?>
<div class="row text-center" style="margin: 5px;">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #f8f8f8">
            <form id="form_editar_aula" name="form_editar_aula" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="hidden-xs">Aula</label>
                            <input class="form-control" id="aula" name="aula" placeholder="Aula" value="<?php echo $aula; ?>">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-3">
                        <div class="form-group">
                            <label class="hidden-xs">Mensalidade</label>
                            <input class="form-control" type="text" id="mensalidade" name="mensalidade" placeholder="Mensalidade" value="<?php echo $mensalidade; ?>">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>