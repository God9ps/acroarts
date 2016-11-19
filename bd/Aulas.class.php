<?php
require 'config.inc.php';

class Aulas extends BDMySQL
{
    var $bd;

    function Aulas()
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

    function atualizarAula($activo,$id)
    {
        $activo = ($activo == 1)?0:1;
        $sql = "update aulas set activo=$activo where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }

    function capturarAulaPeloId($id)
    {
        $sql = "select * from aulas where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result;

    }

    function inserirAula($c)
    {

        $campos = implode(', ', array_keys($c));
        $valores = "'".implode("', '",array_values($c))."'";


        $sql = "INSERT INTO aulas ($campos) VALUES ($valores)";
        $resultado = $this->bd->executarSQL($sql);

        return $resultado;

    }

    function listarAulas(){
        $sql = "SELECT * FROM aulas";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $result;


    }

    function apagarAulas($id)
    {
        $sql = "delete from aulas where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function editarAula($c)
    {
        $id = $c['id'];
        foreach ($c as $key => $value){
            $updates[] = "$key = '$value'";
        }
        $updates = implode(', ', $updates);

        $sql = "UPDATE aulas SET $updates WHERE id='$id'";
        $resultado = $this->bd->executarSQL($sql);

        return $resultado;

    }


    function endAulas()
    {
        $this->bd->fecharBD();
    }
}

?>