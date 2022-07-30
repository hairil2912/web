<?php

class AppearanceModel extends CI_Model
{
	public function menu_insert($data)
	{
		$insert = $this->db->insert('klik_posts', $data);

		if ($insert) {
			return true;
		}

		return false;
	}

	public function get_pages()
	{
		$pages = $this->db->select('p.post_id, p.title, p.content, u.fullname as author, p.status, p.modified_on')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
							'post_type' => 'page',
							'status' => 'publish'
						])->get()->result();
		return $pages;
	}
}