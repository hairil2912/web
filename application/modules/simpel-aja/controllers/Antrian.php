<?php defined('BASEPATH') or exit('No direct script access allowed');

class Antrian extends PasienController
{
    public function index()
    {
        //loket
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/loket",
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

        //poli

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/poliklinik",
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

        $pol = curl_exec($curl);
        $errpol = curl_error($curl);

        curl_close($curl);

        if ($errpol) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errpol
            ];
        } else {
            $pols = json_decode($pol);

            if (@$pols->status === false) {
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
            CURLOPT_URL => $this->base_url . "antrian/apotik",
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

        $apotik = curl_exec($curl);
        $errapotik = curl_error($curl);

        curl_close($curl);

        if ($errapotik) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errapotik
            ];
        } else {
            $apotiks = json_decode($apotik);

            if (@$apotiks->status === false) {
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
            CURLOPT_URL => $this->base_url . "master/poliklinik",
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

        $pol = curl_exec($curl);
        $errpol = curl_error($curl);

        curl_close($curl);

        if ($errpol) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errpol
            ];
        } else {
            $pols = json_decode($pol);

            if (@$pols->status === false) {
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
            CURLOPT_URL => $this->base_url . "antrian/apotik",
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

        $apotik = curl_exec($curl);
        $errapotik = curl_error($curl);

        curl_close($curl);

        if ($errapotik) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errapotik
            ];
        } else {
            $apotiks = json_decode($apotik);

            if (@$apotiks->status === false) {
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

        //dokter
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/dokter",
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

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $err
            ];
        } else {
            $dokters = json_decode($res);

            if (@$dokters->status === false) {
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

        $data['loket'] = $res;
        $data['poli'] = $pols;
        $data['apotik'] = $apotiks;
        $data['dokter'] = $dokters;

        $data['user'] = json_decode($_COOKIE['user']);
        $data['config'] = json_decode($_COOKIE['config']);

        $this->template->simpel_aja('antrian/index', $data);
    }

    public function antrian_dokter()
    {
        $id_dokter  = $this->input->post('id_dokter');
        $tanggal    = $this->input->post('tgl_berobat');
        $token      = $_COOKIE['token'];
        $curl       = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/dokter/$id_dokter?tanggal=$tanggal",
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
        $errdokter = curl_error($curl);
        curl_close($curl);

        if ($errdokter) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errdokter
            ];
        } else {
            $dokters = json_decode($dokter);
            if (@$dokters->status === false) {
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

        $dokters = [
            'no_tiket' => $dokters->no_tiket,
            'no_urut' => $dokters->no_urut,
            'estimasiDipanggilJam' => date('H:i', strtotime($dokters->estimasiDipanggilJam)),
            'total' => $dokters->total . ' Pasien',
            'menunggu' => $dokters->menunggu . ' Pasien',
            'dipanggil' => $dokters->dipanggil . ' Pasien',
        ];

        // $dok = $dokters->no_urut;

        // print_r($dokters);

        echo json_encode($dokters);
    }

    public function antrian_poli()
    {
        $id_ruangan = $this->input->post('id_ruangan');
        $tanggal    = $this->input->post('tgl_berobat');
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "antrian/poli/$id_ruangan?tanggal=$tanggal",
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

        $poli = curl_exec($curl);
        $errpoli = curl_error($curl);

        curl_close($curl);

        // print_r($poli);die;

        if ($errpoli) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errpoli
            ];
        } else {
            $polis = json_decode($poli);
            if (@$polis->status === false) {
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

        $polis = [
            'no_tiket' => $polis->no_tiket,
            'no_urut' => $polis->no_urut,
            'estimasiDipanggilJam' => date('H:i', strtotime($polis->estimasiDipanggilJam)),
            'total' => $polis->total . ' Pasien',
            'menunggu' => $polis->menunggu . ' Pasien',
            'dipanggil' => $polis->dipanggil . ' Pasien',
        ];

        echo json_encode($polis);
    }
}
