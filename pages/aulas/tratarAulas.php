<?php

if (isset ( $_GET ['acao'] )) {
    $acao = $_GET ['acao'];

    include_once '../../bd/BdMySQL.class.php';
    include_once '../../bd/Aulas.class.php';

    $rsAula = new Aulas();

    if ($acao == "preencherTabela") {
        $sql = "SELECT * FROM aulas";
        $resultado = $rsAula->bd->executarSQL($sql);
        $data = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {

            $chk = ($row['activo'] == 1) ? 'checked' : '';

            $functions = '<div>
                                <i class="fa fa-edit fa-pull-left editarAula" id="' . $row['id'] . '" aria-hidden="true"></i>
                                <input type="checkbox" class="activarAula" style="margin-top:0px;" id="' . $row['id'] . '" value="' . $row['activo'] . '" ' . $chk . '>
                           </div>';

            $id = $row ['id'];
            $classeChamada = "";

            array_push($data, array
            (
                'DT_RowId' => $id,
                'DT_RowClass' => $classeChamada,
                'DT_RowData' => 'color=red',

                'aula' => $row ['aula'],

                'mensalidade' => $row ['mensalidade'],

                'functions' => $functions

            ));
        }
        $results = array(
            "sEcho" => "",
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);

    } else if ($acao == "desactivarAulas") {
        $id = $_POST['id'];
        $activo = $_POST['activo'];

        echo $rsAula->atualizarAula($activo, $id);
//        $selectAdmin->atualizarAtivo($activo,$id);

    } else if ($acao == "inserirAula") {

        $c['aula'] = $_POST['aula'];
        $c['mensalidade'] = $_POST['mensalidade'];

        $c['activo'] = '1';

        $rsAula->inserirAula($c);


} else if ($acao == "editarAula") {
    $c['id'] = $_POST['id'];
    $c['aula'] = $_POST['aula'];
    $c['mensalidade'] = $_POST['mensalidade'];
    $c['activo'] = '1';

    $rsAula->editarAula($c);

    }else if ($acao == "apagarAula") {
        $id = $_POST['id'];
        $rsAula->apagarAulas($id);
    }
}else{
    echo "acao?";

}
?>

