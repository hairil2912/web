<?php defined('BASEPATH') or exit ('No direct script access allowed');

class Poli extends SiteController{
    
    public function index()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/master/poliklinik",
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

		$respoli = curl_exec($curl);
		$errpoli = curl_error($curl);

		curl_close($curl);

		if ($errpoli) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errpoli
			];
		} else {
			$respoli = json_decode($respoli);
		}

		$data['poli'] = $respoli;
		$this->template->site($this->theme, 'poli/index', $data);
    }
    
    public function dokter($id_ruangan)
	{
		$id_ruangan = decrypt($id_ruangan);
		// Poli by id
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/master/poli_by_id/$id_ruangan",
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

		$poli = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $err
			];
		} else {
			$polis = json_decode($poli);
		}
		// Dokter by id
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "free/master/dokter/$id_ruangan",
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
		}

		$data['dokter'] = $dokters;
		$data['poli'] = $polis;
		$data['ip'] = $this->url;
		$this->template->site($this->theme, 'poli/dokter', $data);
    }
    
    public function detail_dokter($id_user = null)
	{
		$id_user = decrypt($id_user);
		// Detail DOkter
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "/free/master/dokter_detail/$id_user",
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

		$dokter = curl_exec($curl);
		$errdokter = curl_error($curl);

		curl_close($curl);

		if ($errdokter) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errdokter
			];
		} else {
			$dokter = json_decode($dokter);
		}

		// Jumlah Pasien Dokter
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "/free/master/pasien_dokter/$id_user",
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

		$jumlah = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		if ($error) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $error
			];
		} else {
			$jumlah = json_decode($jumlah);
		}

		$data['detail'] = $dokter->dokter;
		$data['jadwal'] = $dokter->jadwal;
		$data['ip'] = $this->url;
		$data['jumlah'] = $jumlah;
		$this->template->site($this->theme, 'poli/dokter_detail', $data);
	}

    
}