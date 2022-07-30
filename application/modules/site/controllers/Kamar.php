<?php defined ('BASEPATH') or exit ('No direct script access allowed');

class Kamar extends SiteController
{
    public function index()
    {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "kamar",
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

		$reskamar = curl_exec($curl);
		$errkamar = curl_error($curl);

		curl_close($curl);

		if ($errkamar) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errkamar
			];
		} else {
			$reskamar = json_decode($reskamar);
		}

		$data['kamar'] = $reskamar;

		$this->template->site($this->theme, 'kamar/index', $data);
    }
    
    public function detail($id_kelas)
	{
		$id_kelas = decrypt($id_kelas);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "detail_kelas_rawatan/$id_kelas",
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

		$reskelas = curl_exec($curl);
		$errkelas = curl_error($curl);

		curl_close($curl);

		if ($errkelas) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errkelas
			];
		} else {
			$reskelas = json_decode($reskelas);
		}

		$data['ruangan'] = $reskelas;
		$data['kelas'] = $reskelas[0]->kelas_rawatan;
		$this->template->site($this->theme, 'kamar/detail', $data);
	}

	public function bed($id_ruangan)
	{
		$id_ruangan = decrypt($id_ruangan);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->base_url . "detail_bed/$id_ruangan",
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

		$bed = curl_exec($curl);
		$errbed = curl_error($curl);

		curl_close($curl);

		if ($errbed) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errbed
			];
		} else {
			$bed = json_decode($bed);
		}

		$data['bed'] = $bed;
		$data['nama_ruangan'] = $bed[0]->nama_ruangan;
		$this->template->site($this->theme, 'kamar/bed', $data);
	}
}