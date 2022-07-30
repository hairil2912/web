<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class BannerModel extends CI_Model
{

	public function all($limit, $offset)
	{
		$banner = $this->db->select('post_id, title, content, guid, date_format(created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->limit($limit, $offset)
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'banner',
				 		  	 'status' => 'publish'
				 		  ])->result();

		return $banner;
	}

	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
		return $this->db->insert_id();
	}

	public function total()
	{
		$banner = $this->db->select('post_id, title, content, guid')
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'banner',
				 		  	 'status' => 'publish'
				 		  ])->num_rows();

		return $banner;
	}

	public function detail($id)
	{
		$banner = $this->db->get_where('klik_posts',[
								'post_id' => $id
						   ])
						   ->row();

		return $banner;
	}
}