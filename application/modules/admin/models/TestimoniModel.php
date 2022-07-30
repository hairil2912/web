<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class TestimoniModel extends CI_Model
{

	public function all($limit, $offset)
	{
		$testimoni = $this->db->select('p.post_id, p.title, p.status, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->limit($limit, $offset)
				 		  ->get_where('klik_posts p', [
				 		  	 'p.post_type' => 'testimoni'
				 		  ])->result();

		return $testimoni;
	}

	public function total()
	{
		$testimoni = $this->db->select('post_id, title, content, guid')
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'testimoni'
				 		  ])->num_rows();

		return $testimoni;
	}

	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
		return $this->db->insert_id();
	}
}