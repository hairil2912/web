<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends PasienController
{
    public function index()
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/asuransi",
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

        $pol = curl_exec($curl);
        $polerr = curl_error($curl);

        curl_close($curl);

        if ($polerr) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $polerr
            ];
        } else {
            $pol = json_decode($pol);

            if (@$pol->status === false) {
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

        //spesialis
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/spesialis",
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

        $spsesialis = curl_exec($curl);
        $spsesialiserr = curl_error($curl);

        curl_close($curl);

        if ($spsesialiserr) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $spsesialiserr
            ];
        } else {
            $spsesialiss = json_decode($spsesialis);

            if (@$spsesialiss->status === false) {
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

        $data['asuransi'] = $res;
        $data['poli'] = $pol;

        $data['user'] = json_decode($_COOKIE['user']);
        $data['config'] = json_decode($_COOKIE['config']);
        $data['spesialis'] = $spsesialiss;
        $this->template->simpel_aja('pendaftaran/index', $data);
    }

    public function daftar()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $this->form_validation->set_rules('id_asuransi', 'Asuransi', 'required');
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == true) {
                $data = [
                    'id_asuransi' => $this->input->post('id_asuransi'),
                    'id_dokter' => $this->input->post('id_dokter'),
                    'id_ruangan' => $this->input->post('id_ruangan'),
                    'keluhan' => $this->input->post('keluhan'),
                    'pasca_ranap' => $this->input->post('pasca_ranap'),
                    'tgl_berobat' => date('d-m-Y', strtotime(fix_date($this->input->post('tgl_berobat'))))
                ];

                $token = $_COOKIE['token'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->base_url . "registrasi",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
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
                    $response = json_decode($res);
                }
            } else {
                foreach ($this->input->post() as $key => $value) {
                    $response['errors'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        }
    }

    public function dokter($id_ruangan = null)
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/dokter/$id_ruangan",
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
            $doktererr = [
                'status' => false,
                'message' => "cURL Error #:" . $doktererr
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

        $jumlah_dokter = count($dokters) - 1;
        $dokter = $dokters[random_int(0, $jumlah_dokter)];

        echo json_encode($dokter);
    }

    public function success()
    {
        $this->load->view('pendaftaran/success');
    }

    public function dokter_spesialis_bpjs($id_asuransi = null)
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/dokter_spesialis_dua/$id_asuransi",
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

        $data = $dokters;
        echo '<option value="">Pilih</option>';

        foreach ($data as $value) {
            if ($value->is_bpjs_available == '1' && $value->is_praktek == '1') {
                echo '<option value="' . $value->id_user . '"> ' . $value->nama_dokter . ' - ' . $value->nama_prodi . '</option>';
            }
        }
    }

    public function dokter_spesialis($id_asuransi = null)
    {
        $token = $_COOKIE['token'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "master/dokter_spesialis_dua/$id_asuransi",
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

        $data = $dokters;

        echo '<option value="">Pilih Dokter</option>';

        foreach ($data as $value) {
            if ($value->is_praktek == '0') {
                echo '<option value="' . $value->id_user . '"> ' . $value->nama_dokter . ' || ' . $value->nama_prodi . '</option>';
            }
        }
    }
}
