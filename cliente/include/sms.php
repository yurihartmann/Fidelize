<?php

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


function sendSMS($numero, $mensagem)
{

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