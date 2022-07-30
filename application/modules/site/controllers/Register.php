<?php

class Register extends SiteController
{
	public $simrsdb;
	public $id_ub;
	public $vclaim;
	public $client;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RegistrasiModel', 'registrasi');
		$this->simrsdb = $this->load->database('simrs', TRUE);
		$this->load->library('Guzzle/Guzzle');
		$this->client = new GuzzleHttp\Client();

		$ub = $this->simrsdb->from('tbl_mst_user_system')
                  ->select('IFNULL(id_ub,11) as id_ub')
                  ->where('isdefault', 1)
                  ->get()->row();

        $this->id_ub = $ub->id_ub;
        $this->vclaim = 'http://36.67.71.33/simrsapi/public/';
	}

	public function index()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$this->validation_message();
			$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[3]');
			$this->form_validation->set_rules('nik', 'NIK', 'required|numeric|min_length[16]|max_length[16]|callback_check_nik');
			$this->form_validation->set_rules('no_kk', 'No. KK', 'numeric|min_length[16]|max_length[16]');
			$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
			$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('no_hp', 'No. HP', 'required|numeric|min_length[6]|max_length[14]');
			$this->form_validation->set_rules('email', 'Email', 'valid_email');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			if ( $this->form_validation->run($this) ) {
				
				$no_mr = $this->generate_kode_mr();
				$id_pasien = $this->generate_id_user();

				$data = [
					'id_user' => $id_pasien,
					'no_mr' => $no_mr,
					'nama_user' => $this->input->post('nama_lengkap'),
					'tmp_lhr' => $this->input->post('tempat_lahir'),
					'tgl_lhr' => $this->input->post('tanggal_lahir'),
					'id_jk' => $this->input->post('jenis_kelamin'),
					'id_kawin' => $this->input->post('status_kawin'),
					'id_agama' => $this->input->post('agama'),
					'gol_darah' => $this->input->post('golongan_darah'),
					'berat_lahir' => 0,
					'id_jpdd' => $this->input->post('id_jpdd'),
					'id_prodi' => $this->input->post('id_prodi'),
					'id_pekerjaan' => $this->input->post('pekerjaan'),
					'id_pekerjaan_sts' => 10,
					'id_kantor' => 1000,
					'id_grupsdm' => 100,
					'id_desa' => $this->input->post('desa'),
					'alamat' => $this->input->post('alamat'),
					'jenis_identitas' => 'KTP',
					'no_identitas' => $this->input->post('nik'),
					'no_kk' => $this->input->post('no_kk'), 
					'no_hp' => $this->input->post('no_hp'),
					'email' => $this->input->post('email'),
					'grup_user' => 2,
					'sts_user' => 1,
					'date_registered' => date('Y-m-d H:i:s'),
					'user_registered' => $this->input->post('nama_lengkap'),
					'password' => password_hash($id_pasien, PASSWORD_DEFAULT)
				];

				$registrasi = $this->registrasi->pasien_baru($data);

				$response['status'] = true;
				$response['id_user'] = $id_pasien;

			} else {
				$response['status'] = false;
				$response['message'] = 'Mohon periksa kembali isian anda.';
				foreach($this->input->post() as $key => $value) {
					$response['errors'][$key] = form_error($key);
				}
			}

			echo json_encode($response);

		} else {

			$data['religion'] = $this->registrasi->religion();
			$data['pekerjaan'] = $this->registrasi->pekerjaan();
			$data['provinsi'] = $this->registrasi->provinsi();
			$data['jpdd'] = $this->registrasi->jpdd();
			$data['asuransi'] = $this->registrasi->asuransi();

			$this->template->site($this->theme, 'registrasi', $data);
		}
	}

	public function asuransi()
	{

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			if (!empty($this->input->post('asuransi'))) {

				$this->validation_message();
				$this->form_validation->set_rules('no_asuransi', 'No. Asuransi', 'required');
				$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

				if ( $this->form_validation->run($this) ) {

					if ( $this->input->post('asuransi') == '101' ) {
						$no_kartu = $this->input->post('no_asuransi');
						$tanggal_sep = date('Y-m-d');

						try {
							$client = $this->client->request('GET', $this->vclaim.'peserta/kartu/'.$no_kartu.'/'.$tanggal_sep);

						    $peserta = json_decode($client->getBody());

						    if ( $peserta->metaData->code == '200' ) {

						    	if ( $peserta->response->peserta->statusPeserta->keterangan == 'AKTIF' ) {
						    		$status_peserta = 1;
						    	} else {
						    		$status_peserta = 0;
						    	}

						    	$data = [
									'id_asuransi' => $this->input->post('asuransi'),
									'no_asuransi' => $this->input->post('no_asuransi'),
									'no_asuransi_induk' => $this->input->post('no_asuranasi_induk'),
									'id_user' => $this->input->post('id_user'),
									'sts_keanggotaan' => $status_peserta,
									'sts_saldo_asuransi' => 1,
									'jml_ditanggung' => 100,
									'id_kelas_rawatan' => $peserta->response->peserta->hakKelas->kode,
									'date_created' => date('Y-m-d')
								];

								$this->registrasi->asuransi_insert($data);

								$response['status'] = true;

						    } else {
						    	$response['status'] = false;
						    	$response['message'] = $peserta->metaData->message;
						    }

						} catch (GuzzleHttp\Exception\BadResponseException $e) {
							$response['status'] = false;
						    $response['message'] = 'Terjadi kesalahan, mohon coba lagi beberapa saat nanti';
						}
					} else {
						$data = [
							'id_asuransi' => $this->input->post('asuransi'),
							'no_asuransi' => $this->input->post('no_asuransi'),
							'no_asuransi_induk' => $this->input->post('no_asuranasi_induk'),
							'id_user' => $this->input->post('id_user'),
							'date_created' => date('Y-m-d')
						];

						$this->registrasi->asuransi_insert($data);

						$response['status'] = true;
					}

				} else {
					foreach( $this->input->post() as $key => $value ) {
						$response['errors'][$key] = form_error($key);
					}
				}
			} else {
				$response['status'] = true;
			}

			echo json_encode($response);
		}
	}

	public function kabupaten($id_prov)
	{	

		$kabupaten = $this->registrasi->kabupaten($id_prov);

		echo '<option value="">--Kabupaten--</option>';

		foreach($kabupaten as $kab) {
			echo '<option value="'.$kab->id_kabkota.'">'.$kab->nama_kabkota.'</option>';
		}
	}

	public function kecamatan($id_kabkota)
	{
		$kecamatan = $this->registrasi->kecamatan($id_kabkota);

		echo '<option value="">--Kecamatan--</option>';

		foreach($kecamatan as $kec) {
			echo '<option value="'.$kec->id_kec.'">'.$kec->nama_kecamatan.'</option>';
		}	
	}

	public function desa($id_kec)
	{
		$desa = $this->registrasi->desa($id_kec);

		echo '<option value="">--Desa--</option>';

		foreach($desa as $des) {
			echo '<option value="'.$des->id_desa.'">'.$des->nama_desa.'</option>';
		}	
	}

	public function prodi($id_jpdd)
	{
		$prodi = $this->registrasi->prodi($id_jpdd);

		echo '<option value="">--Program Studi--</option>';
		
		foreach($prodi as $prod) {
			echo '<option value="'.$prod->id_prodi.'">'.$prod->nama_prodi.'</option>';
		}
	}

	public function check_nik($val)
	{	
		if (empty($val)) {
			$this->form_validation->set_message('check_nik', 'NIK harus diisi.');
	            return FALSE;
		} else {

			$user = $this->simrsdb->select('no_identitas, func_nama_lengkap(gelar_dpn, nama_user, gelar_blk) as nama_lengkap')
								  ->get_where('tbl_mst_user', [
								  	'no_identitas' => $val
								  ]);

			if ( $user->num_rows() > 0 ){

				$pasien = $user->row();

	            $this->form_validation->set_message('check_nik', 'NIK yang anda masukkan sudah digunakan oleh pasien dengan nama ' . $pasien->nama_lengkap);
	            return FALSE;
	        } else {
	            return TRUE;
	        }
		}
	}

	public function generate_kode_mr()
    {
        $no_mr = $this->simrsdb->from('tbl_mst_user')
					           ->select('RIGHT(no_mr,6) as kode')
					           ->order_by('id_user','DESC')
					           ->limit(1)
					           ->get();    
        if($no_mr->num_rows() <> 0){         
            $data = $no_mr->row();      
            $kode = intval($data->kode) + 1;    
        }
        else {       
            $kode = 1;    
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); 
        $kodejadi = "R-".$kodemax;  
        return $kodejadi;
    }

    public function generate_id_user()
    {
    	$id_user = $this->simrsdb->from('tbl_mst_user')
						           ->select('RIGHT(id_user,4) as kode')
						           ->where('LEFT(id_user, 6) =' . $this->id_ub.date('y').date('m'), null, false)
						           ->order_by('id_user','DESC')
						           ->limit(1)
						           ->get();    
        if($id_user->num_rows() <> 0){       
            $data = $id_user->row();      
            $kode = intval($data->kode) + 1;    
        }
        else {        
            $kode = 1;    
        }

        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = $this->id_ub.date('y').date('m').$kodemax;
        return $kodejadi;
    }
}