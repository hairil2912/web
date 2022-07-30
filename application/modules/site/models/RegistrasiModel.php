<?php

class RegistrasiModel extends CI_Model
{	
	public $simrsdb;

	public function __construct()
	{
		parent::__construct();
		$this->simrsdb = $this->load->database('simrs', TRUE);
	}

	public function religion()
	{
        $religion = $this->simrsdb->get('tbl_mst_agama')
                      ->result();
    
        return $religion;
	}

	public function pekerjaan()
	{
        $pekerjaan = $this->simrsdb->get('tbl_mst_pekerjaan')
                      ->result();
    
        return $pekerjaan;
	}

	public function pasien_baru($data)
	{
		$insert = $this->simrsdb->insert('tbl_mst_user', $data);

		return $this->simrsdb->insert_id();
	}

	public function provinsi()
	{
		return $this->simrsdb->get('tbl_mst_provinsi')->result();
	}

	public function kabupaten($id_prov)
	{
		return $this->simrsdb->get_where('tbl_mst_kabkota', [
			'id_prov' => $id_prov
		])->result();
	}

	public function kecamatan($id_kab)
	{
		return $this->simrsdb->get_where('tbl_mst_kec', [
			'id_kabkota' => $id_kab
		])->result();
	}

	public function desa($id_kec)
	{
		return $this->simrsdb->get_where('tbl_mst_desa', [
			'id_kec' => $id_kec
		])->result();
	}

	public function jpdd()
	{
		return $this->simrsdb->get('tbl_mst_jpdd')->result();
	}

	public function prodi($id_jpdd)
	{
		return $this->simrsdb->get_where('tbl_mst_jpdd_prodi', [
			'id_jpdd' => $id_jpdd
		])->result();
	}

	public function asuransi()
	{
		return $this->simrsdb->get_where('tbl_mst_asuransi', [
			'isdefault' => 0
		])->result();
	}

	public function asuransi_insert($data)
	{
		return $this->simrsdb->insert('tbl_mst_user_asuransi', $data);
	}
}