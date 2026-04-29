<?php

class SMS extends CApplicationComponent
{
    private $to;
    private $sender;
    private $text;

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function send()
    {
        $curl = curl_init();

        $params = [
            'username'=>'docscs08',
            'password'=>'EstErTEn',
            'from'=>$this->sender,
            'to'=>$this->to,
            'message'=>$this->message,
            'route'=>'GW2',
            'delivery'=>'s',
            'returnURL'=>'',
            'idrefer'=>''
        ];

        $queryString = http_build_query($params);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://legacy.messageglobe.com/send_sms/register.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $queryString,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: charset=UTF-8'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

}