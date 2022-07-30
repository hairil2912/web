<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class TeamModel extends CI_Model
{

	public function all($limit, $offset)
	{
		$team = $this->db->select('p.post_id, p4.meta_value as jobtitle, p1.meta_value as facebook, p2.meta_value as twiter, p3.meta_value as gplus, img.guid as img, p.title, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="klik_team_attachment"')
						  ->join('klik_posts img', 'img.post_id = pm.meta_value')
						  ->join('klik_postmeta p4', 'p4.post_id = p.post_id and p4.meta_key ="klik_team_jobtitle"') 
						  ->join('klik_postmeta p1', 'p1.post_id = p.post_id and p1.meta_key ="klik_team_facebook"', 'left')
						  ->join('klik_postmeta p2', 'p2.post_id = p.post_id and p2.meta_key ="klik_team_twitter"', 'left')
						  ->join('klik_postmeta p3', 'p3.post_id = p.post_id and p3.meta_key ="klik_team_gplus"', 'left')
						  ->limit($limit, $offset)
				 		  ->get_where('klik_posts p', [
				 		  	 'p.post_type' => 'team',
				 		  	 'p.status' => 'publish'
				 		  ])->result();

		return $team;
	}

	public function total()
	{
		$team = $this->db->select('post_id, title, content, guid')
				 		  ->get_where('klik_posts', [
				 		  	 'post_type' => 'team',
				 		  	 'status' => 'publish'
				 		  ])->num_rows();

		return $team;
	}

	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
		return $this->db->insert_id();
	}
}