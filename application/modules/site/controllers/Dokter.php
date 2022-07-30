<?php defined ('BASEPATH') or exit ('No direct script access allowed');

class Dokter extends SiteController
{

	public function index()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/master/dokter",
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

		$res_dokter = curl_exec($curl);
		$errdokter = curl_error($curl);

		curl_close($curl);

		if ($errdokter) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errdokter
			];
		} else {
			$res_dokter = json_decode($res_dokter);
		}

		$data['dokters'] = $res_dokter;
        $data['ip']		 = $this->url;
        
		$this->template->site($this->theme, 'dokter/index', $data);
	}
}