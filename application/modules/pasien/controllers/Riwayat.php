<?php defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "riwayat",
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
                'status' => false,
                'message' => "cURL Error #:" . $errrwt
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

        $data['user'] = json_decode($_COOKIE['user']);
        $data['riwayat'] = $resrwt;
        $data['riwatar_tr'] = $res_rwt_transaksi;

        $this->template->pasien('riwayat/index', $data);
    }

    public function detail_transaksi($no_register = null)
    {
        $token = $_COOKIE['token'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "/riwayat_transaksi/$no_register",
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

        $riwayat_transaksi = curl_exec($curl);
        $riwayaterr = curl_error($curl);

        curl_close($curl);

        if ($riwayaterr) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $riwayaterr
            ];
        } else {

            $riwayats = json_decode($riwayat_transaksi);

            if (@$riwayat_transaksi->status === false) {
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
        $data['riwayat'] = $riwayats;
        // print_r($data['riwayat']); die;

        $this->load->view('riwayat/detail_transaksi', $data);
    }

    public function detail($no_register = null)
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "/riwayat/$no_register",
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

        $riwayat = curl_exec($curl);
        $riwayaterr = curl_error($curl);

        curl_close($curl);

        if ($riwayaterr) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $riwayaterr
            ];
        } else {

            $riwayats = json_decode($riwayat);

            if (@$riwayat->status === false) {
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
        $data['riwayat'] = $riwayats;
        $data['diagnosa_primer'] = $riwayats->diagnosa->primer;
        $data['diagnosa_sekunder'] = json_encode($riwayats->diagnosa);
        $data['rwt_tindakan'] = json_encode($riwayat);
        $data['rwt_resep'] = $riwayats->resep->tunggal;
        $data['rwt_resep_racikan'] = $riwayats->resep->racikan;

        $this->load->view('riwayat/detail', $data);
    }
}
