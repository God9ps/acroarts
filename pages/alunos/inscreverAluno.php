<?php
include_once '../../bd/BdMySQL.class.php';

include_once '../../bd/Aulas.class.php';

$rsAula = new Aulas();

$id = $_POST['id'];

$resultado = $rsAula->listarAulas();

//extract($resultado);
?>
<div class="row text-center" style="margin: 5px;">
    <div class="panel panel-default">
        <div class="panel-body" style="background-color: #f8f8f8">
            <form id="form_inscrever_aluno" name="form_inscrever_aluno" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label class="hidden-xs">Aulas</label>

                            <select class="form-control" id="id_aula" name="id_aula">
                                <option>Seleccione a aula</option>
                                <?php
                                    foreach ($resultado as $valor){
                                    echo "<option value='".$valor['id']."'>".$valor['aula']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>