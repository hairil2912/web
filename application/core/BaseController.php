<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class BaseController extends MX_Controller
{

	public $base_url = "http://localhost/simrsapi/public/";
	public $url = "http://localhost/";

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}

	public function validation_message(){

		$pesan = array(
						'required'		   => 	'%s harus diisi.',
						'valid_email'	   => 	'%s harus format email.',
						'numeric'		   => 	'%s harus diisi angka.',
						'matches'		   =>	'%s tidak cocok dengan %s.',
						'is_unique'		   =>	'%s Anda telah terdaftar',
						'max_length'	   =>  '%s maksimal %s karakter.',
						'min_length'	   =>  '%s minimal %s karakter.',
						'alpha_dash'	   =>	'%s diisi alpabet, numerik, dan garis bawah.',
						'alpha'			   =>  '%s diisi dengan format alpha a-z',
						'valid_url_format' =>  '%s format salah, contoh (htpp://www.xxxxx.com)',
						'is_natural'	   =>  '%s harus format angka 0-9',
						'is_numeric'	   =>  '%s harus format angka 0-9',
					  );
		foreach($pesan as $key => $value){

			$this->form_validation->set_message($key, $value);
		}

	}

}