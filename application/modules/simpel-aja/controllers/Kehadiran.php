<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        $tgl_berobat = date('d-m-Y');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/cekAntrian?tanggal=$tgl_berobat&token=$token",
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

        $res_rwt = curl_exec($curl);
        $errwt = curl_error($curl);

        curl_close($curl);

        if ($errwt) {
            $response = [
                'status'    => false,
                'message'   => "cURL Error #:" . $errwt
            ];
        } else {
            $res_rwt = json_decode($res_rwt);
        }

        @$no_reg = $res_rwt->no_register;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . 'antrian/cekIsconfirm?no_register=' . @$no_reg . '',
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

        $resConfirm = curl_exec($curl);
        $errConfir = curl_error($curl);

        curl_close($curl);

        if ($errConfir) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errConfir
            ];
        } else {
            $resConfirm = json_decode($resConfirm);

            if (@$resConfirm->status === false) {
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

        $data['user']               = json_decode($_COOKIE['user']);
        $data['profilRs']           = json_decode($_COOKIE['profilRs']);
        $data['isconfirm'] = $resConfirm;
        $data['rwt'] = $res_rwt;
        

        $data['barcode'] = site_url('simpel-aja/barcode?no_tiket_full=' . @$data['rwt']->no_tiket_full . '');

        $this->template->simpel_aja('kehadiran/index', $data);
    }

    public function detail()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        $tgl_berobat = date('d-m-Y');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/cekAntrian?tanggal=$tgl_berobat&token=$token",
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

        $res_rwt = curl_exec($curl);
        $errwt = curl_error($curl);

        curl_close($curl);

        if ($errwt) {
            $response = [
                'status'    => false,
                'message'   => "cURL Error #:" . $errwt
            ];
        } else {
            $res_rwt = json_decode($res_rwt);
        }

        $uri = $this->uri->segment(4);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/cekIsconfirm?no_tiket_full=$uri",
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

        $resConfirm = curl_exec($curl);
        $errConfir = curl_error($curl);

        curl_close($curl);

        if ($errConfir) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errConfir
            ];
        } else {
            $resConfirm = json_decode($resConfirm);

            if (@$resConfirm->status === false) {
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

        $data['user']      = json_decode($_COOKIE['user']);
        $data['profilRs']  = json_decode($_COOKIE['profilRs']);
        $data['isconfirm'] = $resConfirm;
        $data['barcode']   = site_url('simpel-aja/barcode?no_tiket_full=' . $this->uri->segment(4));

        $this->template->simpel_aja('kehadiran/barcode', $data);
    }
}
