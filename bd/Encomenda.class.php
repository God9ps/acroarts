<?php
require 'config.inc.php';

class Encomenda extends BDMySQL
{
    var $bd;

    function Encomenda()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }

    function introduzirEncomenda($idUser,$preco, $tipoPagamento)
    {
        $sql = "insert into encomenda (id_user, data, total, tipo_envio)values ('$idUser', CURRENT_TIMESTAMP, '$preco', $tipoPagamento)";
        return $this->bd->executarSQLWithID($sql);
    }

    function introduzirProdutoEncomenda($idEncomenda,$idProduto,$qtd)
    {
        $sql = "insert into lista_encomenda (id_encomenda, id_produto, quantidade)values ('$idEncomenda', '$idProduto', '$qtd')";
        return $this->bd->executarSQL_T($sql);
    }

    function encomendaPaga($paga,$id)
    {
        $sql = "update encomenda set paga=$paga, nova=0 where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }


    function encomendaEnviada($enviada,$id)
    {
        $sql = "update encomenda set enviada=$enviada, nova=0 where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }


    function contadorNaoPagas(){
        $sql = "SELECT COUNT(*) FROM encomenda WHERE paga=0";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];

    }



    function totalUltimoMes(){
        $sql = "SELECT SUM(quantidade) FROM lista_encomenda";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];

    }


    function contadorEncomendasNovas(){
        $sql = "SELECT COUNT(*) FROM encomenda WHERE nova=1";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];

    }

    function contadorNaoEnviadas(){
        $sql = "SELECT COUNT(*) FROM encomenda WHERE enviada=0";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];
    }

    function contadorPorTratar(){
        $sql = "SELECT COUNT(*) FROM encomenda WHERE enviada=0 OR paga=0";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];
    }
    /*

    function verificarExisteEmail($email)
    {
        $email = trim($email);
        $sql = "select * from utilizador where email = '$email'";
        if (($this->bd->executarSQL($sql))) {
            $rs = $this->bd->executarSQL($sql);
            if ($rs->fetch(PDO::FETCH_ASSOC) == false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function alterarUtilizador($id, $email, $contato, $nome, $precoKm, $precoVisita)
    {
        $sql = "update utilizador set precoKm='$precoKm', precoVisita='$precoVisita', email='$email', telefone='$contato', nome='$nome' where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function alterarPassUtilizador($id, $pass)
    {
        $sql = "update utilizador set truque='$pass' where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function eliminarUtilizador($id)
    {
        $sql = "delete from utilizador where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function verificarExisteUtilizador($email, $password)
    {
        $email = trim($email);
        $password = trim($password);
        $sql = "select * from utilizador where email = '$email' and truque = '$password'";
        if (($this->bd->executarSQL($sql))) {
            $rs = $this->bd->executarSQL($sql);
            if ($rs->fetch(PDO::FETCH_ASSOC) == false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    function verificarUtilizadorAtivo($email)
    {
        $sql = "select activo from utilizador where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function verificarNomePorEmail($email)
    {
        $sql = "select nome from utilizador where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function verificarNomePorId($id)
    {
        $sql = "select nome from utilizador where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function verificarEmailPorId($id)
    {
        $sql = "select email from utilizador where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function verificarIdPorEmail($email)
    {
        $sql = "select id from utilizador where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function saberPrecoKmDomicare($id)
    {
        $sql = "select precoKm from utilizador where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function saberPrecoVisitaDomicare($id)
    {
        $sql = "select precoVisita from utilizador where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endUtilizador();
    }

    function guardarVisita($email)
    {
        $sql = "update utilizador set data_visita=now(), contador_visitas=contador_visitas+1 where email='$email'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }


    


    function verificarNivel($email)
    {
        $email = trim($email);
        $sql = "select nivel from utilizador where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result['nivel'];
    }

    function verificarHospitalId($email)
    {
        $email = trim($email);
        $sql = "select hospital from utilizador where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result['hospital'];
    }

    function verificarNivelUtilizador($nivel)
    {
        if ($nivel == 0) {
            $resultado = "Super Administrador";
        }
        elseif ($nivel == 1) {
            $resultado = "Administrador";
        } elseif ($nivel == 2) {
            $resultado = "Enf. Domicare";
        }elseif ($nivel == 3) {
            $resultado = "Prof. de Saúde";
        }
        return $resultado;
    }*/

    function endEncomenda()
    {
        $this->bd->fecharBD();
    }
}

?>