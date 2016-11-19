<?php
require 'config.inc.php';

class Alunos extends BDMySQL
{
    var $bd;

    function Alunos()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }


    function contadorAlunos(){
        $sql = "SELECT COUNT(*) FROM alunos";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endAlunos();
        return $result[0];

    }

    function listarAlunos(){
        $sql = "SELECT * FROM alunos WHERE activo=1";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endAlunos();
        return $result;
    }

    function atualizarAluno($activo,$id)
    {
        $activo = ($activo == 1)?0:1;
        $sql = "update alunos set activo=$activo where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }

    function capturarAlunoPeloId($id)
    {
        $sql = "select * from alunos where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result;

    }

    function apagarAlunos($id)
    {
        $sql = "delete from alunos where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function inserirAlunos($c)
    {

        $campos = implode(', ', array_keys($c));
        $valores = "'".implode("', '",array_values($c))."'";


        $sql = "INSERT INTO alunos ($campos) VALUES ($valores)";
        $resultado = $this->bd->executarSQL($sql);

        return $resultado;

    }

    function editarAlunos($c)
    {
        $id = $c['id'];
        foreach ($c as $key => $value){
            $updates[] = "$key = '$value'";
        }
        $updates = implode(', ', $updates);

        $sql = "UPDATE alunos SET $updates WHERE id='$id'";
        $resultado = $this->bd->executarSQL($sql);

        return $resultado;

    }

    function endAlunos()
    {
        $this->bd->fecharBD();
    }
}

?>