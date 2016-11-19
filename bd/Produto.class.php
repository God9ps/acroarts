<?php
require 'config.inc.php';

class Produto extends BDMySQL
{
    var $bd;

    function Produto()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }

    function atualizarProdutoAtivo($activo,$id)
    {
        $sql = "update produto set activo=$activo where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }

    function atualizarCategoriaAtivo($activo,$id)
    {
        $sql = "update categoria set activo=$activo where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }

//    function updateProduto1($id, $nome, $descricao,$peso,$preco, $promocao,$precoPromocao,$stock,$estrelas)
//    {
//        $sql = "update produto set nome='$nome', descricao='$descricao', peso= '$peso', preco='$preco', promocao='$promocao', precoPromocao='$precoPromocao', stock='$stock', estrelas='$estrelas', imagem='', activo='1' where id='$id'";
////        $sql = "update produto set nome='$nome' where id='$id'";
//
//        echo $this->bd->executarSQL_T($sql);
//    }

    function updateProduto($id,$categoria,$nome,$peso,$preco,$promocao,$precoPromocao,$stock,$estrelas,$descricao,$activo,$upload)
    {
        if ($upload == ''){
            $sql = "update produto set categoria='$categoria', nome='$nome', descricao='$descricao', peso= '$peso', preco='$preco', promocao='$promocao', precoPromocao='$precoPromocao', stock='$stock', estrelas='$estrelas', activo='$activo' where id='$id'";
        }else{
            $sql = "update produto set categoria='$categoria', nome='$nome', descricao='$descricao', peso= '$peso', preco='$preco', promocao='$promocao', precoPromocao='$precoPromocao', stock='$stock', estrelas='$estrelas', imagem='$upload', activo='$activo' where id='$id'";
        }

        $this->bd->executarSQL_T($sql);
    }

    function inserirProduto($categoria,$nome,$peso,$preco,$promocao,$precoPromocao,$stock,$estrelas,$descricao,$activo,$imagem)
    {
        $imagem = ($imagem == '')? 'noimage.jpg':$imagem;
        $sql = "INSERT INTO produto (nome, categoria, peso, preco, promocao, precoPromocao, stock, estrelas, descricao, imagem, activo)
                VALUES ('$nome', '$categoria', '$peso', '$preco', '$promocao', '$precoPromocao', '$stock', '$estrelas', '$descricao','$imagem', '$activo')";

        return $this->bd->executarSQL_T($sql);
    }



    function produtoPorId($id)
    {
        $sql = "SELECT * FROM produto WHERE id='$id'";
        echo $this->bd->executarSQL($sql);
    }

    function eliminarProduto($id)
    {
        $sql = "delete from produto where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function listarCategorias()
    {
        $sql = "SELECT * FROM categoria WHERE activo=1";
        echo $this->bd->executarSQL_T($sql);
    }

    function contadorProdutos(){
        $sql = "SELECT COUNT(*) FROM produto";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];
    }

    /*function introduzirUtilizador($password, $nivel, $email, $contato, $nome, $hospital,$precoKm, $precoVisita)
    {
        $sql = "insert into utilizador (truque, nivel, email, telefone, nome, hospital, precoKm, precoVisita)values ('$password','$nivel','$email','$contato','$nome','$hospital','$precoKm','$precoVisita')";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

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

    function endProduto()
    {
        $this->bd->fecharBD();
    }
}

?>