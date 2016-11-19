<?php
require 'config.inc.php';
include_once("phpmailer/class.phpmailer.php");

class Alerta extends BDMySQL
{
    var $bd;

    function Alerta()
    {
        global $NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME;
        $this->bd = new BDMySQL ();
        $this->bd->ligarBD($NOME_BD, $USER_BD, $PASS_BD, $SERVER_NAME);
    }

    function enviarEmail($assunto, $descrição, $emailDe, $nomeDe, $emailPara, $nomePara)
    {
        // Inicia a classe PHPMailer
        $mail = new PHPMailer();
        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = "mail.codeboys.pt"; // Endereço do servidor SMTP
        $mail->SMTPAuth = true; // Autenticação
        $mail->Username = 'email@codeboys.pt'; // Usuário do servidor SMTP
        $mail->Password = 'codeboys2016'; // Senha da caixa postal utilizada
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = $emailDe; // Seu e-mail
        $mail->FromName = $nomeDe; // Seu nome
        // Define os destinatário(s)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->AddAddress('gordett@me.com', 'Luis Filipe');
        $mail->AddAddress($emailPara, $nomePara);
       /* $sql1 = "select email from utilizador where id='$idMaterial' and hospital='$hospital' and utilizado=0";
        $resultado1=$this->bd->executarSQL($sql1);
        while ($row = $resultado1->fetch(PDO::FETCH_ASSOC)) {

        }*/
//        $mail->AddAddress('ciclano@site.net');
        //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
        // Define os dados técnicos da Mensagem
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
        // Define a mensagem (Texto e Assunto)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject = utf8_decode($assunto); // Assunto da mensagem
        $mail->Body = utf8_decode($descrição);
        $mail->AltBody = utf8_decode($assunto);
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
        // Envi a o e-mail
        $enviado = $mail->Send();
        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        // Exibe uma mensagem de resultado
        if ($enviado) {
//            echo "E-mail enviado com sucesso!";
            return true;
        } else {
//            echo "Não foi possível enviar o e-mail.";
//            echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
            return $mail->ErrorInfo;
        }
    }

    function enviarEmailAdministrador($assunto, $descrição, $emailDe, $nomeDe)
    {
        // Inicia a classe PHPMailer
        $mail = new PHPMailer();
        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//        $mail->IsSMTP(); // Define que a mensagem será SMTP
//        $mail->Host = "smtp.gmail.com"; // Endereço do servidor SMTP
//        $mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
//        $mail->Username = 'gordett@gmail.com'; // Usuário do servidor SMTP
//        $mail->Password = 'asdasdasd'; // Senha do servidor SMTP
        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = $emailDe; // Seu e-mail
        $mail->FromName = $nomeDe; // Seu nome
        // Define os destinatário(s)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->AddAddress('gordett@me.com', 'Luis Filipe');
        $sql1 = "select nome,email from utilizador where nivel=1 and activo=1";
        $resultado1=$this->bd->executarSQL($sql1);
        while ($row1 = $resultado1->fetch(PDO::FETCH_ASSOC)) {
             $mail->AddAddress($row1['email'], $row1['nome']);
        }
//        $mail->AddAddress('ciclano@site.net');
        //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
        // Define os dados técnicos da Mensagem
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
        // Define a mensagem (Texto e Assunto)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject = utf8_decode($assunto); // Assunto da mensagem
        $mail->Body = utf8_decode($descrição);
        $mail->AltBody = utf8_decode($assunto);
        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
        // Envi a o e-mail
        $enviado = $mail->Send();
        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        // Exibe uma mensagem de resultado
        if ($enviado) {
//            echo "E-mail enviado com sucesso!";
            return true;
        } else {
//            echo "Não foi possível enviar o e-mail.";
//            echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
            return $mail->ErrorInfo;
        }
    }

    function endAlerta()
    {
        $this->bd->fecharBD();
    }
}

?>