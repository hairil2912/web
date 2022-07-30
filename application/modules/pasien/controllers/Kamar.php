<?php defined ('BASEPATH') OR exit ('No direct script access allowed');


class Kamar extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."kamar",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer ".$token
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $reskamar = curl_exec($curl);
        $errkamar = curl_error($curl);

        curl_close($curl);

        if ($errkamar) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errkamar
            ];
        } else {
            $reskamar = json_decode($reskamar);

           if (@$reskamar->status === false) {
                unset($_COOKIE['token']);
                unset($_COOKIE['config']);
                unset($_COOKIE['user']);
                unset($_COOKIE['profilRs']);

                setcookie('token', null, -1, '/');
                setcookie('config', null, -1, '/');
                setcookie('user', null, -1, '/');
                setcookie('profilRs', null, -1, '/');
               redirect('pendaftaran/login');
           } 
        }

        $data['user'] = json_decode($_COOKIE['user']);
        $data['kamar'] = $reskamar;

        $this->template->pasien('kamar/index', $data);
    }
}