<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "riwayat_transaksi",
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

        $res_rwt_transaksi = curl_exec($curl);
        $errrwt = curl_error($curl);

        curl_close($curl);

        if ($errrwt) {
            $response = [
                'status'    => false,
                'message'   => "cURL Error #:" . $errrwt
            ];
        } else {
            $res_rwt_transaksi = json_decode($res_rwt_transaksi);

            if (@$res_rwt_transaksi->status === false) {
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

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . 'antrian/cekIsconfirm?no_register=' . @$res_rwt_transaksi[0]->no_register . '',
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
        $data['jmlh_berobat']       = count($res_rwt_transaksi);
        $data['no_register']        = @$res_rwt_transaksi[0]->no_register;
        $data['riwayat_berobat']    = $res_rwt_transaksi;
        $data['isconfirm'] = $resConfirm;
        $data['barcode'] = site_url('sirusi/barcode?no_register=' . $data['no_register'] . '');

        $this->template->pasien('kehadiran/index', $data);
    }

    public function detail()
    {
        $uri = $this->uri->segment(4);
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/cekIsconfirm?no_register=$uri",
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
        $data['barcode']   = site_url('sirusi/barcode?no_register=' . $this->uri->segment(4));
        $data['isconfirm'] = $resConfirm;

        $this->template->pasien('kehadiran/barcode', $data);
    }
}
