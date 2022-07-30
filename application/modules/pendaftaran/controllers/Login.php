<?php

class Login extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('login/index');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('id', 'Email / No.HP / NIK', 'required');
            $this->form_validation->set_rules('pin', 'Password', 'required');
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == true) {
                $data = [
                    'user' => [
                        'id' => $this->input->post('id'),
                        'pin' => $this->input->post('pin'),
                    ]
                ];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->base_url . "login",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
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
                    if ($res->status === true) {
                        $token =  [
                            'name' => 'token',
                            'value' => $res->token,
                            'expire' => time() + (10 * 365 * 24 * 60 * 60),
                            'secure' => FALSE,
                            'path' => '/',
                        ];
                        $config = [
                            'name' => 'config',
                            'value' => json_encode([
                                'is_rumkit' => $res->is_rumkit,
                                'enable_vclaim' => $res->enable_vclaim
                            ]),
                            'expire' => time() + (10 * 365 * 24 * 60 * 60),
                            'secure' => FALSE,
                            'path' => '/',
                        ];

                        $user = [
                            'name' => 'user',
                            'value' => json_encode($res->user),
                            'expire' => time() + (10 * 365 * 24 * 60 * 60),
                            'secure' => FALSE,
                            'path' => '/',
                        ];

                        $profilRs = [
                            'name' => 'profilRs',
                            'value' => json_encode($res->profilRs),
                            'expire' => time() + (10 * 365 * 24 * 60 * 60),
                            'secure' => FALSE,
                            'path' => '/',
                        ];

                        $this->input->set_cookie($token);
                        $this->input->set_cookie($config);
                        $this->input->set_cookie($user);
                        $this->input->set_cookie($profilRs);
                        if ($this->url == 'http://103.141.148.136/') {
                            $response = [
                                'status'    => true,
                                'redirect'  => site_url('simpel-aja/home'),
                            ];
                        } else {
                            $response = [
                                'status'    => true,
                                'redirect'  => site_url('pasien/home'),
                            ];
                        }
                    } else {
                        $response = [
                            'status' => false,
                            'message' => "Username atau password salah."
                        ];
                    }
                }
            } else {
                $response['status'] = false;
                foreach ($this->input->post() as $key => $val) {
                    $response['errors'][$key] = form_error($key);
                }
            }
        }
        echo json_encode($response);
    }

    public function registrasi()
    {
        //provinsi
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "free/master/provinsi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $resprovinsi = curl_exec($curl);
        $errprovinsi = curl_error($curl);

        curl_close($curl);

        if ($errprovinsi) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errprovinsi
            ];
        } else {
            $resprovinsi = json_decode($resprovinsi);
        }

        //asuransi
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "/free/master/asuransi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $resasu = curl_exec($curl);
        $errasu = curl_error($curl);

        curl_close($curl);

        if ($errasu) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errasu
            ];
        } else {
            $resasu = json_decode($resasu);
        }

        $data['provinsi'] = $resprovinsi;
        $data['asuransi'] = $resasu;

        $this->load->view('login/register', $data);
    }

    public function register_akun()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data2 = [
                'email' => $this->input->post('email')
            ];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->base_url . "cek_email",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data2),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

            $resemail = curl_exec($curl);
            $err_email = curl_error($curl);
            curl_close($curl);

            if ($err_email) {
                $response = [
                    'status' => false,
                    'message' => "cURL Error #:" . $err_email
                ];
            } else {
                $res = json_decode($resemail);
                if ($res->status === true) {
                    $data = [
                        'register' => [
                            "nama" => $this->input->post('nama'),
                            "tempat_lahir" => $this->input->post('tempat_lahir'),
                            "tanggal_lahir" => fix_date($this->input->post('tanggal_lahir')),
                            "jenis_kelamin" => $this->input->post('jenis_kelamin'),
                            "status_kawin" => $this->input->post('status_kawin'),
                            "agama" => $this->input->post('agama'),
                            "desa" => $this->input->post('id_desa'),
                            "alamat" => $this->input->post('alamat'),
                            "password" => $this->input->post('password'),
                            "no_hp" => $this->input->post('no_hp'),
                            "email" => $this->input->post('email'),
                            "nik" => $this->input->post('nik'),
                            "id_asuransi" => $this->input->post('id_asuransi'),
                            "no_asuransi" => $this->input->post('no_asuransi')
                        ]
                    ];

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $this->base_url . "register",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => json_encode($data),
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                    ));

                    curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                    $resp    = curl_exec($curl);
                    $err    = curl_error($curl);
                    curl_close($curl);

                    if ($err) {
                        $response = [
                            'status'    => false,
                            'message'   => "cuRL Error #:" . $err
                        ];
                    } else {
                        $respp = json_decode($resp);
                        if ($respp->status === true) {
                            $token =  [
                                'name' => 'token',
                                'value' => $respp->token,
                                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                'secure' => FALSE,
                                'path' => '/',
                            ];
                            $config = [
                                'name' => 'config',
                                'value' => json_encode([
                                    'is_rumkit' => $respp->is_rumkit,
                                    'enable_vclaim' => $respp->enable_vclaim
                                ]),
                                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                'secure' => FALSE,
                                'path' => '/',
                            ];

                            $user = [
                                'name' => 'user',
                                'value' => json_encode($respp->user),
                                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                'secure' => FALSE,
                                'path' => '/',
                            ];

                            $profilRs = [
                                'name' => 'profilRs',
                                'value' => json_encode($respp->profilRs),
                                'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                'secure' => FALSE,
                                'path' => '/',
                            ];

                            $this->input->set_cookie($token);
                            $this->input->set_cookie($config);
                            $this->input->set_cookie($user);
                            $this->input->set_cookie($profilRs);
                            if ($this->url == 'http://103.141.148.136/') {
                                $response = [
                                    'status'    => true,
                                    'redirect'  => site_url('simpel-aja/home'),
                                ];
                            } else {
                                $response = [
                                    'status'    => true,
                                    'redirect'  => site_url('pasien/home'),
                                ];
                            }
                        }
                    }
                } else {
                    $response = $res;
                }
            }
            echo json_encode($response);
        }
    }

    public function aktivasi_akun()
    {
        $this->load->view('login/aktivasi');
    }

    public function aktivasi()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('id', 'Nik/No. Kartu Berobat', 'required');
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('tgl_lhr', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == true) {
                $data = [
                    'id'        => $this->input->post('id'),
                    'nama'      => $this->input->post('nama'),
                    'tgl_lahir'   => fix_date($this->input->post('tgl_lhr')),
                    'password'  => $this->input->post('password'),
                ];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->base_url . "aktivasi",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
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
                    if ($res->status === true) {
                        $data_2 = [
                            "user" => [
                                'id'    => $this->input->post('id'),
                                'pin'   => $this->input->post('password'),
                            ]
                        ];
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $this->base_url . "login",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => json_encode($data_2),
                            CURLOPT_HTTPHEADER => array(
                                "Content-Type: application/json"
                            ),
                        ));

                        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                        $resp    = curl_exec($curl);
                        $err    = curl_error($curl);
                        curl_close($curl);

                        if ($err) {
                            $response = [
                                'status'    => false,
                                'message'   => "cuRL Error #:" . $err
                            ];
                        } else {
                            $respp = json_decode($resp);
                            if ($respp->status === true) {
                                $token =  [
                                    'name' => 'token',
                                    'value' => $respp->token,
                                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                    'secure' => FALSE,
                                    'path' => '/',
                                ];
                                $config = [
                                    'name' => 'config',
                                    'value' => json_encode([
                                        'is_rumkit' => $respp->is_rumkit,
                                        'enable_vclaim' => $respp->enable_vclaim
                                    ]),
                                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                    'secure' => FALSE,
                                    'path' => '/',
                                ];

                                $user = [
                                    'name' => 'user',
                                    'value' => json_encode($respp->user),
                                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                    'secure' => FALSE,
                                    'path' => '/',
                                ];

                                $profilRs = [
                                    'name' => 'profilRs',
                                    'value' => json_encode($respp->profilRs),
                                    'expire' => time() + (10 * 365 * 24 * 60 * 60),
                                    'secure' => FALSE,
                                    'path' => '/',
                                ];

                                $this->input->set_cookie($token);
                                $this->input->set_cookie($config);
                                $this->input->set_cookie($user);
                                $this->input->set_cookie($profilRs);
                                if ($this->url == 'http://103.141.148.136/') {
                                    $response = [
                                        'status'    => true,
                                        'redirect'  => site_url('simpel-aja/home'),
                                    ];
                                } else {
                                    $response = [
                                        'status'    => true,
                                        'redirect'  => site_url('pasien/home'),
                                    ];
                                }
                            }
                        }
                    } else {
                        $response = [
                            'status'    => false,
                            'message'   => 'Data Tidak Ditemukan Silahkan Registrasi Pasien Baru..!!!',
                        ];
                    }
                }
            } else {
                $response['status'] = false;
                $response['message'] = 'Mohon periksa kembali isian anda...!!!!';
                foreach ($this->input->post() as $key => $val) {
                    $response['errors'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        }
    }

    public function get_kabupaten($id_prov = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "free/master/kabupaten/$id_prov",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $reskab = curl_exec($curl);
        $errkab = curl_error($curl);

        curl_close($curl);

        if ($errkab) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errkab
            ];
        } else {
            $reskab = json_decode($reskab);
        }

        $data = $reskab;

        echo '<option value="">Pilih Kabupaten</option>';

        foreach ($data as $value) {
            echo '<option value="' . $value->id_kabkota . '">' . $value->nama_kabkota . '</option>';
        }
    }

    public function get_kecamatan($id_kab = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "free/master/kecamatan/$id_kab",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $reskec = curl_exec($curl);
        $errkec = curl_error($curl);

        curl_close($curl);

        if ($errkec) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errkec
            ];
        } else {
            $reskec = json_decode($reskec);
        }

        $data = $reskec;

        echo '<option value="">Pilih Kecamatan</option>';

        foreach ($data as $value) {
            echo '<option value="' . $value->id_kec . '">' . $value->nama_kecamatan . '</option>';
        }
    }

    public function get_desa($id_kec = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->base_url . "free/master/desa/$id_kec",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
            ),
        ));

        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $resdesa = curl_exec($curl);
        $errdesa = curl_error($curl);

        curl_close($curl);

        if ($errdesa) {
            $response = [
                'status' => false,
                'message' => "cURL Error #:" . $errdesa
            ];
        } else {
            $resdesa = json_decode($resdesa);
        }

        $data = $resdesa;

        echo '<option value="">Pilih Desa</option>';

        foreach ($data as $value) {
            echo '<option value="' . $value->id_desa . '">' . $value->nama_desa . '</option>';
        }
    }

    public function logout()
    {
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
