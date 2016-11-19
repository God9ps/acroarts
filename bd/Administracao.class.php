<?php
require 'config.inc.php';

class Administracao extends BDMySQL
{
    var $bd;

    function Administracao()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }

    function verificarExisteAdmin($email, $password)
    {
        $email = trim($email);
        $password = trim($password);
        $sql = "select * from admin where email = '$email' and truque = '$password'";
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

    function verificarAdminAtivo($email)
    {
        $sql = "select activo from admin where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endAdmin();
    }

    function verificarIdAdminPorEmail($email)
    {
        $sql = "select id from admin where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endAdmin();
    }

    function verificarNomeAdminPorEmail($email)
    {
        $sql = "select nome from admin where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endAdmin();
    }

    function verificarNivel($email)
    {
        $email = trim($email);
        $sql = "select nivel from admin where email = '$email'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result['nivel'];
    }

    
    function guardarVisita($email)
    {
        $sql = "update admin set data_visita=now(), contador_visitas=contador_visitas+1 where email='$email'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function atualizarAtivo($activo,$id)
    {
        $sql = "update admin set activo='$activo' where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    /*function introduzirAdmin($nome, $truque, $email, $nivel, $data_registo, $data_visita,$contador_visitas)
    {
        $sql = "insert into admin (nome, truque, email, nivel, data_registo, $data_visita, contador_visitas) 
                values ('$nome','$truque','$email','$nivel','$data_registo','$data_visita','$contador_visitas')";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function verificarExisteEmail($email)
    {
        $email = trim($email);
        $sql = "select * from admin where email = '$email'";
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

    function alterarAdmin($id, $nome, $truque, $email, $nivel)
    {
        $data_visita = date();
        $sql = "update admin set nome='$nome', truque='$truque', email='$email', nivel='$nivel', data_visita='$data_visita' where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function alterarPassAdmin($id, $pass)
    {
        $sql = "update admin set truque='$pass' where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }

    function eliminarAdmin($id)
    {
        $sql = "delete from admin where id='$id'";
        if ($this->bd->executarSQL($sql))
            return true;
        else
            return false;
    }







    function verificarNomeAdminPorId($id)
    {
        $sql = "select nome from admin where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endAdmin();
    }

    function verificarEmailAdminPorId($id)
    {
        $sql = "select email from admin where id = '$id'";
        $resultado = $this->bd->executarSQL($sql);
        $result = $resultado->fetch();
        return $result[0];
        $this->endAdmin();
    }







    function verificarNivel($nivel)
    {
        if ($nivel == 0) {
            $resultado = "Super Administrador";
        }
        elseif ($nivel == 1) {
            $resultado = "Administrador";
        } elseif ($nivel == 2) {
            $resultado = "Utilizador";
        }
        return $resultado;
    }*/

    function endAdmin()
    {
        $this->bd->fecharBD();
    }

    function listaAdmin()
    {

        $sql = "select * from admin";
        if (($rs = $this->bd->executarSQL($sql))) {
//            $rs = $this->bd->executarSQL($sql); fazes aqui 2 pedidos bd desnecessrio  assim? eu sei que isto fui eu que fiz :)
            if ($rs->fetch(PDO::FETCH_ASSOC) == false) {
                return false;
            } else {
                print_r($rs); // é a mesma coisa certo???
                return $rs; //isto e um array mas o arrau para datatables tem campos especificos
            }
        } else {
            return false;
        }
    }
}

?>