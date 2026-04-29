<?php

class Tools extends CApplicationComponent
{
    public static function surveyRadioAnswer($a)
    {
        $radio = [
            'P' => 'POCO',
            'A' => 'ABBASTANZA',
            'M' => 'MOLTO'
        ];

        return $radio[$a];
    }

    public static function listRangeData($start, $end)
    {
        for($i = $start; $i <= $end; $i++) {
            $data[$i] = $i;
        }

        return $data;
    }

    public static function uploadImageToFileSystem($api, $token, $payload)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.cooperativadoc.it/api/$api",
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$token,
                "Content-Type:application/json"
            ),
        ));

        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($httpcode == 201) {
            return true;
        }

        return false;
    }
}