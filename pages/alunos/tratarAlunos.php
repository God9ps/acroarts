<?php


if (isset ( $_GET ['acao'] ))
{
    $acao = $_GET ['acao'];
    include_once '../../bd/BdMySQL.class.php';
    include_once '../../bd/Alunos.class.php';
    include_once '../../bd/Inscricoes.class.php';

    $selectAluno = new Alunos();
    $rsInscricoes = new Incricao();
    if ($acao == "preencherTabela")
    {
        $sql = "SELECT * FROM alunos";
        $resultado = $selectAluno->bd->executarSQL($sql);
        $data = array();

        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {


            $imagem = '<img src="pages/imagens/'.$row['foto'].'" style="width:150px;" class="img-circle img-responsive center-block"/>';

            $tabela = "<table width='100%'>
                           <tr>
                               <td class='legenda' style='text-align: center'>{$imagem}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Nome : </h1>{$row['nome']}</td>
                           </tr>
                            <tr>
                               <td class='legenda' style='text-align: center'><h1>Data Nascimento : </h1>{$row['data_nascimento']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Morada : </h1>{$row['morada']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Codigo Postal : </h1>{$row['cod_postal']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Localidade : </h1>{$row['localidade']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>E-Mail : </h1>{$row['mail']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Telefone : </h1>{$row['telefone']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>Filho de : </h1>{$row['pai']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>e de </h1>{$row['mae']}</td>
                           </tr>
                           <tr>
                               <td class='legenda' style='text-align: center'><h1>E-Mail de Contacto : </h1>{$row['mail_contacto']}</td>
                           </tr></table>";




            $foto  = '<img src="pages/imagens/' . $row['foto'].'" class="img-circle img-responsive" width="50px"/><i class="fa fa-arrow-down pull-right detail" aria-hidden="true"></i>';

            $chk = ($row['activo'] == 1) ? 'checked' : '';

            $functions  = '<div>
                                <i class="fa fa-edit fa-pull-left editar" style="margin-right: 8px" title="Editar Aluno" id="'.$row['id'].'" aria-hidden="true"></i>
                                <input type="checkbox" class="activar pull-left" style="margin-right: 8px" title="Activar/Desactivar Aluno" style="margin-top:0px;" id="'.$row['id'].'" value="'.$row['activo'].'" '.$chk.'>
                                <i class="fa fa-sign-in fa-pull-left inscrever" style="margin-right: 8px" title="Inscrever em Aula" id="'.$row['id'].'" name="'.$row['nome'].'" aria-hidden="true"></i>
                           </div>';

            $id=$row ['id'];
            $classeChamada = "";

            array_push($data, array
            (
                'DT_RowId' => $id,
                'DT_RowClass' => $classeChamada,
                'DT_RowData' => 'color=red',
                'foto' => $foto,
                'tabela' => $tabela,
                'nome' => $row ['nome'],

                'telefone' => $row ['telefone'],
                'mail' => $row ['mail'],
                'functions' => $functions

            ));
        }
        $results = array(
            "sEcho" => "",
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
    }
    else if ($acao == "desactivarAlunos"){
        $id = $_POST['id'];
        $activo = $_POST['activo'];

        echo $selectAluno->atualizarAluno($activo,$id);
//        $selectAdmin->atualizarAtivo($activo,$id);
    }

    else if ($acao == "inscreverAluno"){
        $c['id_aula'] = $_POST['id_aula'];
        $c['id_aluno'] = $_POST['id_aula'];
        $c['data_inscricao'] = date('Y-m-d');
        $c['activo'] = '1';
        $rsInscricoes->inscreverAlunos($c);
//        $selectAdmin->atualizarAtivo($activo,$id);
    }

    else if ($acao == "alterarAluno") {


        $ficheiro = $_FILES['foto'];
        $pasta = "../imagens/";
        if (!file_exists($pasta)) mkdir ($pasta, 0755);

        if($ficheiro['tmp_name']){
            $extencao = strchr($ficheiro['name'], '.');
            $filename = md5(time()).$extencao;
            if(move_uploaded_file($ficheiro['tmp_name'],$pasta.$filename)){
                $c['id']              = $_GET['id'];
                $c['nome']            = $_POST['nome'];
                $c['morada']          = $_POST['morada'];
                $c['cod_postal']      = $_POST['cod_postal'];
                $c['localidade']      = $_POST['localidade'];
                $c['telefone']        = $_POST['telefone'];
                $c['mail']            = $_POST['mail'];
                $c['pai']             = $_POST['pai'];
                $c['mae']             = $_POST['mae'];
                $c['mail_contacto']   = $_POST['mail_contacto'];
                $c['data_nascimento'] = $_POST['data_nascimento'];
                $c['foto']            = $filename;
                $c['activo']          = '1';

                $selectAluno->editarAlunos($c);

            }
        }else{
            $c['id']              = $_GET['id'];
            $c['nome']            = $_POST['nome'];
            $c['morada']          = $_POST['morada'];
            $c['cod_postal']      = $_POST['cod_postal'];
            $c['localidade']      = $_POST['localidade'];
            $c['telefone']        = $_POST['telefone'];
            $c['mail']            = $_POST['mail'];
            $c['pai']             = $_POST['pai'];
            $c['mae']             = $_POST['mae'];
            $c['mail_contacto']   = $_POST['mail_contacto'];
            $c['data_nascimento'] = $_POST['data_nascimento'];
            $c['activo']          = '1';
            unset($c['foto']);
            $selectAluno->editarAlunos($c);
        }
    }
    else if ($acao == "inserirAluno") {


        $ficheiro = $_FILES['foto'];
        $pasta = "../imagens/";
        if (!file_exists($pasta)) mkdir ($pasta, 0755);

        if($ficheiro['tmp_name']){
            $extencao = strchr($ficheiro['name'], '.');
            $filename = md5(time()).$extencao;
            if(move_uploaded_file($ficheiro['tmp_name'],$pasta.$filename)){

                $c['nome']            = $_POST['nome'];
                $c['morada']          = $_POST['morada'];
                $c['cod_postal']      = $_POST['cod_postal'];
                $c['localidade']      = $_POST['localidade'];
                $c['telefone']        = $_POST['telefone'];
                $c['mail']            = $_POST['mail'];
                $c['pai']             = $_POST['pai'];
                $c['mae']             = $_POST['mae'];
                $c['mail_contacto']   = $_POST['mail_contacto'];
                $c['data_nascimento'] = $_POST['data_nascimento'];
                $c['foto']            = $filename;
                $c['activo']          = '1';

                $selectAluno->inserirAlunos($c);
            }else{
                echo '1';
            }
        }else{
            echo '2';
        }
    }else if ($acao == "apagarAluno") {
        $id = $_POST['id'];
        $selectAluno->apagarAlunos($id);
    }
}
else

    echo "acao?";
/*}
else
{
    header('Location: index.php');
}*/
?>

