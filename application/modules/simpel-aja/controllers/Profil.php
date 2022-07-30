<?php defined ('BASEPATH') OR exit ('no direct script access allowed');

class Profil extends PasienController
{
    public function index()
    {
        
        $data['user'] = json_decode($_COOKIE['user']);

        $this->template->simpel_aja('profil/index', $data);
    }

    public function update()
    {
        if ( $_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $response = [
                'status' => false
            ];

            $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required');
            $this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tgl_lhr', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('tmp_lhr', 'Tempat Lahir', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');

			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>'); 

            if ( $this->form_validation->run() == true )
            {
                $data = [
                   'user' => [
                       'nama_lengkap' => $this->input->post('nama_lengkap'),
                       'id_jk' => $this->input->post('id_jk'),
                       'tgl_lhr' => $this->input->post('tgl_lhr'),
                       'tmp_lhr' => $this->input->post('tmp_lhr'),
                       "alamat" => $this->input->post('alamat'),
                       "email" => $this->input->post('email'),
                       "no_hp" => $this->input->post('no_hp'),
                   ]
                ];

                $token = $_COOKIE['token'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->base_url."akun/biodata",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
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
                    $response = json_decode($res);
                    if ($response->status === true) {
                        $user = [
                            'name' => 'user',
                            'value' => json_encode($data['user']),
                            'expire' => time() + (10 * 365 * 24 * 60 * 60),
                            'secure' => FALSE,
                            'path' => '/',
                        ];
                        $this->input->set_cookie($user);
                    } 
                }
                
            } else {
                foreach ($this->input->post() as $key => $value ) {
                    $response['errors'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        }
    }

    public function ganti_pin()
    {
        if ( $_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $response = [
                'status' => false
            ];

            $this->form_validation->set_rules('pinLama', 'Pin Lama', 'required');
            $this->form_validation->set_rules('pinBaru', 'Pin Baru', 'required');

			$this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>'); 

            if ( $this->form_validation->run() == true )
            {
                $data = [
                   'pinLama' => $this->input->post('pinLama'),
                   'pinBaru' => $this->input->post('pinBaru'),
                ];

                $token = $_COOKIE['token'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $this->base_url."akun/ganti_pin",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($data),
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
                    $response = json_decode($res);
                    // if ($response->status === true) {
                    //     $user = [
                    //         'name' => 'user',
                    //         'value' => json_encode($data['user']),
                    //         'expire' => time() + (10 * 365 * 24 * 60 * 60),
                    //         'secure' => FALSE,
                    //         'path' => '/',
                    //     ];
                    //     $this->input->set_cookie($user);
                    // } 
                }
                
            } else {
                foreach ($this->input->post() as $key => $value ) {
                    $response['errors'][$key] = form_error($key);
                }
            }
            echo json_encode($response);
        }
    }
}