<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class TestimoniModel extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
		return $this->db->insert_id();
	}
}