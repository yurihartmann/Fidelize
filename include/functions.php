<?php

/**
 * FUNÇÕES
 */

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;
use PHPMailer\PHPMailer\PHPMailer;

function setAlerta($tipo, $mensagem)
{
    $alerta['tipo'] = $tipo;
    $alerta['msg'] = $mensagem;
    setcookie('alerta', serialize($alerta), time() + 5);
}

function getAlerta()
{
    if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
        $alerta = unserialize($_COOKIE['alerta']);
        include "alerta.php";
    }

}

function clearAlerta()
{
    setcookie('alerta');
}

function getModal()
{
    if (isset($_COOKIE['modal']) && !is_null($_COOKIE['modal'])) {
        $modal = unserialize($_COOKIE['modal']);
        if (isset($_COOKIE['modal_show']) && !is_null($_COOKIE['modal_show'])) {
            $modal['show'] = 'true';
        }
        include "modal.php";
    }
}

function setModal($dados)
{
    $modal = $dados;
    setcookie('modal');
    setcookie('modal_show', true, time() + 5);
    setcookie('modal', serialize($modal), time() + (60 * 10));
}

function formatacaoCelular($numero)
{
    $ddd = "(" . substr($numero, 0, 2) . ")";
    $number = " " . substr($numero, 2, 5) . "-";
    $number = $number . substr($numero, 7, 4);

    $numero = $ddd . $number;
    return $numero;
}

function formatacaoData($data)
{

    $data_explose = explode('-', $data);
    $ano = $data_explose[0];
    $mes = $data_explose[1];
    $dia = $data_explose[2];

    return $dia . "/" . $mes . "/" . $ano;

}

function formatacaoDataHora($data)
{
    $data_explose = explode(' ', $data);
    return formatacaoData($data_explose[0]) . " " . $data_explose[1];
}


function limitaTexto($quantidade_caracteres, $texto)
{

    if (strlen($texto) > $quantidade_caracteres) {
        $texto = substr($texto, 0, $quantidade_caracteres) . " ...";
    }

    return $texto;
}

function formatarDataParaSalvar($data)
{
    // ageita a hora para salvar
    $inicio = explode(" ", $data);
    $inicio_data = explode("/", $inicio[0]);
    $inicio_data = $inicio_data[2] . "-" . $inicio_data[1] . "-" . $inicio_data[0];
    $inicio_hora = $inicio[1];
    return $inicio_data . " " . $inicio_hora;
}

function limpaMascaraNumero($numero)
{
    $numero = str_replace('(', '', $numero);
    $numero = str_replace(')', '', $numero);
    $numero = str_replace(' ', '', $numero);
    return str_replace('-', '', $numero);
}

function setEmailDigitado($email)
{
    //$email['email'] = $email;
    setcookie('email_digitado', serialize($email), time() + 30);
}

function getEmailDigitado()
{
    if (isset($_COOKIE['email_digitado']) && !is_null($_COOKIE['email_digitado'])) {
        $email = unserialize($_COOKIE['email_digitado']);
        return $email;
    }
}

function sendSMS($numero, $mensagem){


    if (SMS_ACTIVE) {

        $SnSclient = new SnsClient([
            'credentials' => ['key' => SNS_KEY, 'secret' => SNS_SECRET],
            'region' => 'us-west-2',
            'version' => '2010-03-31'
        ]);

        $phone = $numero;
        $phone = "+55" . $phone;
        $message = $mensagem;
        $message = limitaTexto(130, $message);

        try {
            $result = $SnSclient->SetSMSAttributes([
                'attributes' => [
                    'DefaultSMSType' => 'Transactional',
                ],
            ]);
            $result = $SnSclient->publish([
                'Message' => $message,
                'PhoneNumber' => $phone,
            ]);
        } catch (AwsException $e) {
            // output error message if fails
            $e->getMessage();
        }
    }

    sleep(1);
}

function sendEmailResetPassword($email, $nome, $senha_nova){

    $body = file_get_contents('../include/template_email/recuperacao_senha.html');
    $body = str_replace("%NOME%", $nome, $body);
    $body = str_replace("%SENHANOVA%", $senha_nova, $body);

    return sendEmail("Recuperação de Senha", $body, $email);
}

function sendEmailToken($email, $nome, $token, $nome_cartao, $premio)
{
    $body = file_get_contents('../include/template_email/token.html');
    $body = str_replace("%NOME%", $nome, $body);
    $body = str_replace("%NOMECARTAO%", $nome_cartao, $body);
    $body = str_replace("%PREMIO%", $premio, $body);
    $body = str_replace("%TOKEN%", $token, $body);

    return sendEmail("Parabéns, Você completou seu cartão: " . $nome_cartao ."!", $body, $email);
}

function sendEmail($subject,$body, $email) {

    if (EMAIL_ACTIVE) {
        // Iniciando um novo objeto
        $mail = new PHPMailer();

        // Configurações UTF-8
        $mail->CharSet = "UTF-8";

        // Codificação do e-mail
        $mail->Enconding = "base64";

        // Forçando o e-mail a ter o corpo em HTML
        $mail->IsHTML(true);

        // Ativar o SMTP
        $mail->IsSMTP();

        // Ativando a autenticação
        $mail->SMTPAuth = true;

        // Uso de certificados
        $mail->SMTPSecure = 'ssl';

        // Servidor SMTP utilizado para enviar o e-mail
        $mail->Host = 'smtp.gmail.com';

        // Porta do servidor SMTP
        $mail->Port = 465;

        // Usuario do servidor
        $mail->Username = EMAIL_USER;

        // Senha do servidor
        $mail->Password = EMAIL_PASSWORD;

        // Definindo o remetente
        $mail->SetFrom(EMAIL_USER, "Fidelize");

        // Definindo o assunto
        $mail->Subject = $subject;

        // Definindo o corpo do e-mail
        $mail->Body = $body;

        // Definindo o destinarário
        $mail->AddAddress($email);


        // Enviando o e-mail
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }
}



?>
