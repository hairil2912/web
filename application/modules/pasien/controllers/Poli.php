<?php defined('BASEPATH') or exit('No direct script access allowed');

class Poli extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/poli",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $respoli = curl_exec($curl);
        $errpoli = curl_error($curl);

        curl_close($curl);

        if ($errpoli) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errpoli
            ];
        } else {
            $respoli = json_decode($respoli);
            // print_r($reskamar); die;

            if (@$respoli->status === false) {
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
        $data['poli'] = $respoli;
        $this->template->pasien('poli/index', $data);
    }

    public function dokter_poli($id_user = null)
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/dokter/$id_user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $dokter = curl_exec($curl);
        $doktererr = curl_error($curl);

        curl_close($curl);

        if ($doktererr) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $doktererr
            ];
        } else {
            $dokters = json_decode($dokter);

            if (@$dokter->status === false) {
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
        $data['dokter'] = $dokters;
        // echo "<pre>";
		// print_r($data['dokter']);die;
        $this->template->pasien('poli/dokter_poli', $data);
    }

    public function detail_dokter($id_user = null)
    {
        $token = $_COOKIE['token'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "/free/master/dokter_detail/$id_user",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $token
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $detail_dokter = curl_exec($curl);
        $detailss = curl_error($curl);

        curl_close($curl);

        if ($detailss) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $detailss
            ];
        } else {

            $detail = json_decode($detail_dokter);

            if (@$detail_dokter->status === false) {
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
        $data['detail'] = $detail->dokter;
        $this->load->view('poli/detail_dokter', $data);
    }
}
