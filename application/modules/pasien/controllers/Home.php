<?php defined ('BASEPATH') OR exit ('no direct script access allowed');

class Home extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."master/asuransi",
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

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $err
            ];
        } else {
            $res = json_decode($res);

           if (@$res->status === false) {
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

        //riwayat

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url."riwayat",
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

        $resrwt = curl_exec($curl);
        $errrwt = curl_error($curl);

        curl_close($curl);

        if ($errrwt) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errrwt
            ];
        } else {
            $resrwt = json_decode($resrwt);

           if (@$resrwt->status === false) {
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
        $data['profilRs'] = json_decode($_COOKIE['profilRs']);
        $data['riwayat'] = $resrwt;
        
        $this->template->pasien('home/index', $data);
    }
}