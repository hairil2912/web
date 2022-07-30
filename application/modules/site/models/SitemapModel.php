<?php

class SitemapModel extends CI_Model
{
	public function getURLS()
	{
		return $this->db->get_where('klik_posts', [
			'post_type' => 'post',
			'status' => 'publish'
		])->result();
	}

	public function getCategory()
	{
		$sql = $this->db->select('tt.term_taxonomy_id, t.name, tt.description, t.slug')
				 		->from('klik_term_taxonomy tt')
				 		->join('klik_terms t', 'tt.term_id = t.term_id')
				 		->where('tt.taxonomy', 'category')
				 		->order_by('t.name', 'asc');

		return $sql->get()->result();
	}

	public function pages()
	{
		$sql = $this->db->select('p.post_id, p.slug, p.title, p.content, u.fullname as author, p.status, p.modified_on')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
							'post_type' => 'page',
							'status' => 'publish'
						])->get();

		return $sql->result();
	}
}