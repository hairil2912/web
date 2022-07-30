<?php defined ('BASEPATH') or exit ('No direct script access allowed');

class Antrian extends SiteController{
    
    public function index()
    {
		//apotik
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/antrian/apotik_table",
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
		}

		//poli
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/antrian/poliklinik",
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
		}

		$data['apotik'] = $apotiks;
		$data['poli'] = $pols;

		$this->template->site($this->theme, 'antrian/index', $data);
	}
}