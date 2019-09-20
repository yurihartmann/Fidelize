<?php

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


function sendSMS($numero, $mensagem){


    $SnSclient = new SnsClient([
        'credentials' => ['key' => 'AKIA2ZZM2LL4FW3JSEQ2', 'secret' => '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'],
        'region' => 'us-west-2',
        'version' => '2010-03-31'
    ]);

    $phone = $numero;
    $phone = "+55" .$phone;
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

    sleep(1);

}