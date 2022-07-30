<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class SlideModel extends CI_Model
{

	public function all($limit, $offset)
	{
		$slide = $this->db->select('post_id, title, content, guid, date_format(created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->limit($limit, $offset)
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'slide',
				 		  	 'status' => 'publish'
				 		  ])->result();

		return $slide;
	}

	public function total()
	{
		$slide = $this->db->select('post_id, title, content, guid')
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'slide',
				 		  	 'status' => 'publish'
				 		  ])->num_rows();

		return $slide;
	}

	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
		return $this->db->insert_id();
	}
}