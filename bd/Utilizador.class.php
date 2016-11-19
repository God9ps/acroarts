<?php
require 'config.inc.php';

class Utilizador extends BDMySQL
{
    var $bd;

    function Utilizador()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }

   /* function introduzirUtilizador($nome, $email, $md5Pass, $morada, $cp, $localidade, $telefone, $nif)
    {
        $sql = "insert into utilizador (nome, email, truque, morada, cp, localidade, telefone, nif, data_registo)values ('$nome','$email','$md5Pass','$morada','$cp','$localidade','$telefone','$nif', CURRENT_TIMESTAMP )";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }*/

//    function introduzirUtilizador($password, $nivel, $email, $contato, $nome, $hospital,$precoKm, $precoVisita)
//    {
//        $sql = "insert into utilizador (truque, nivel, email, telefone, nome, hospital, precoKm, precoVisita)values ('$password','$nivel','$email','$contato','$nome','$hospital','$precoKm','$precoVisita')";
//        if ($this->bd->executarSQL($sql))
//            return true;
//        else
//            return false;
//    }
    function contadorAlunos(){
        $sql = "SELECT COUNT(*) FROM alunos";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
//        $this->endEncomenda();
        return $result[0];
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

    function atualizarUtilizador($id,$nome,$morada,$cp,$localidade,$telefone,$nif,$password,$email)
    {
        if (empty($password)){
            $sql = "update utilizador set nome='$nome', morada='$morada',cp='$cp', localidade='$localidade', telefone='$telefone', nif='$nif', email='$email' where id='$id'";
            echo $this->bd->executarSQL_T($sql);
        }else{
            $md5pass= md5($password);
            $sql = "update utilizador set nome='$nome', truque='$md5pass' morada='$morada',cp='$cp', localidade='$localidade', telefone='$telefone', nif='$nif', email='$email' where id='$id'";
            echo $this->bd->executarSQL_T($sql);

            //Adicionar função para enviar e-mail ao administrador a informar a nova password...

        }
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
    }



    function atualizarAtivo($activo,$id)
    {
        $sql = "update admin set activo=$activo where id='$id'";
        echo $this->bd->executarSQL_T($sql);
    }

    function atualizarAdmin($id,$nome,$password,$email)
    {
        if (empty($password)){
            $sql = "update admin set nome='$nome', email='$email' where id='$id'";
            echo $this->bd->executarSQL_T($sql);
        }else{
            $md5pass= md5($password);
            $sql = "update admin set nome='$nome', password='$md5pass', email='$email' where id='$id'";
            echo $this->bd->executarSQL_T($sql);

            //Adicionar função para enviar e-mail ao administrador a informar a nova password...

        }
    }

    function adicionarAdmin($nome,$password,$email,$nivel)
    {
            $md5pass = md5($password);
            $activo = 1;
            $data_registo = date('Y-m-d H:i');
            $sql = "insert into admin (nome, truque, email, nivel, activo, data_registo, data_visita, contador_visitas)values ('$nome','$md5pass','$email','$nivel','$activo','$data_registo','','')";

            echo $this->bd->executarSQL_T($sql);


            //Adicionar função para enviar e-mail ao administrador a informar o registo e password...



    }


    function endUtilizador()
    {
        $this->bd->fecharBD();
    }
}

?>