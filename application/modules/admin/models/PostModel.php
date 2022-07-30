<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class PostModel extends CI_Model
{
	public function count_post_by_status()
	{
		$sql = $this->db->query("select
			sum(if(p.status != 'trash', 1, 0)) as all_post, 
			sum(if(p.status = 'publish', 1, 0)) as publish,
			sum(if(p.status = 'draft', 1, 0)) as draft,
			sum(if(p.status = 'trash', 1, 0)) as trash	 
		from klik_posts p
		where p.post_type = 'post'");

		return $sql->row();
	}

	public function get_total_by_type($type)
	{
		$status = null;
		switch ($type) {
			case 'publish':
				$status = 'publish';
				break;
			case 'draft':
				$status = 'draft';
				break;
			case 'trash':
				$status = 'trash';
				break;
			default:
				$status = null;
				break;
		}

		$sql = $this->db->select('p.post_id, p.title, u.fullname as author, "Categories" as category, "Tags" as tags, p.modified_on')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->group_by('p.post_id')
						->where([
							'post_type' => 'post'
						]);
		if (!empty($status) and $status != 'trash') {
			$this->db->where('status', $status);
			$this->db->where('deleted_on is null', null, false);
		}

		if (!empty($status) and $status == 'trash') {
			$this->db->where('status', $status);
			$this->db->where('deleted_on is not null', null, false);
		}

		if ($status == null) {
			$this->db->where('deleted_on is null', null, false);
		}

		return $sql->get()->num_rows();
	}

	public function all($type, $limit, $offset)
	{
		$status = null;
		switch ($type) {
			case 'publish':
				$status = 'publish';
				break;
			case 'draft':
				$status = 'draft';
				break;
			case 'trash':
				$status = 'trash';
				break;
			default:
				$status = null;
				break;
		}

		$sql = $this->db->select('p.post_id, p.title, u.fullname as author, "Categories" as category, p.modified_on, p.status')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
							'post_type' => 'post'
						]);
		if (!empty($status) and $status != 'trash') {
			$this->db->where('status', $status);
			$this->db->where('deleted_on is null', null, false);
		}

		if (!empty($status) and $status == 'trash') {
			$this->db->where('status', $status);
			$this->db->where('deleted_on is not null', null, false);
		}

		if ($status == null) {
			$this->db->where('deleted_on is null', null, false);
		}

		$this->db->limit($limit, $offset);

		return $sql->get()->result();
	}

	public function get_post_tags($params = array())
	{
		$sql = $this->db->select('tt.term_taxonomy_id, t.name, tt.description')
				 		->from('klik_term_taxonomy tt')
				 		->join('klik_terms t', 'tt.term_id = t.term_id')
				 		->where('tt.taxonomy', 'tag')
				 		->order_by('t.name', 'asc');
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

		return $sql->get()->result();
	}

	public function get_post_categories($params = array())
	{
		$sql = $this->db->select('tt.term_taxonomy_id, t.name, tt.description')
				 		->from('klik_term_taxonomy tt')
				 		->join('klik_terms t', 'tt.term_id = t.term_id')
				 		->where('tt.taxonomy', 'category')
				 		->order_by('t.name', 'asc');
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }

		return $sql->get()->result();
	}

	public function category_detail($id)
	{
		$sql = $this->db->select('tt.term_taxonomy_id, t.name, tt.description, tt.parent')
				 		->from('klik_term_taxonomy tt')
				 		->join('klik_terms t', 'tt.term_id = t.term_id')
				 		->where('tt.taxonomy', 'category')
				 		->where('tt.term_taxonomy_id', $id);

		return $sql->get()->row();
	}

	public function tag_detail($id)
	{
		$sql = $this->db->select('tt.term_taxonomy_id, t.name, tt.description')
				 		->from('klik_term_taxonomy tt')
				 		->join('klik_terms t', 'tt.term_id = t.term_id')
				 		->where('tt.taxonomy', 'tag')
				 		->where('tt.term_taxonomy_id', $id);

		return $sql->get()->row();
	}

	public function create($post_data, $categories, $tags, $meta)
	{
		$this->db->trans_begin();

			$insert_post = $this->db->insert('klik_posts', $post_data);
			$post_id = $this->db->insert_id();

			$post_categories = [];

			if (count($categories) > 0) {
				foreach($categories as $category) {
					$post_categories[] = [
						'object_id' => $post_id,
						'term_taxonomy_id' => $category
					];
				}
			}


			$post_tags = [];

			if (!empty($tags)) {
				foreach (explode(',', $tags) as $tag) {

					$tag = ltrim($tag);

					$is_tag_exist = $this->is_tag_exist($tag);

					if ( ! $is_tag_exist ) {

						$this->db->insert('klik_terms', [
							'name' => $tag,
							'slug' => str_slug($tag)
						]);
						$term_id = $this->db->insert_id();

						$this->db->insert('klik_term_taxonomy', [
							'term_id' => $term_id,
							'taxonomy' => 'tag'
						]);
						$taxonomy_id = $this->db->insert_id();

						$post_tags[] = [
							'object_id' => $post_id,
							'term_taxonomy_id' => $taxonomy_id
						];

					} else {
						$post_tags[] = [
							'object_id' => $post_id,
							'term_taxonomy_id' => $is_tag_exist
						];
					}
				}
			}


			if ( count($post_categories) > 0 ) {
				$this->db->insert_batch('klik_term_relationships', $post_categories);
			}

			if ( count($post_tags) > 0 ) {
				$this->db->insert_batch('klik_term_relationships', $post_tags);
			}

			$meta = [
				[
					'post_id' => $post_id,
					'meta_key' => 'featured_image',
					'meta_value' => $meta['featured_image']
				]
			];

			$this->db->insert_batch('klik_postmeta', $meta);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
		
	}

	public function update($post_id, $post_data, $categories, $tags, $meta)
	{
		$this->db->trans_begin();

			$this->db->where('post_id', $post_id)->update('klik_posts', $post_data);
			$this->db->where('object_id', $post_id)->delete('klik_term_relationships');

			$post_categories = [];

			if (count($categories) > 0) {
				foreach($categories as $category) {
					$post_categories[] = [
						'object_id' => $post_id,
						'term_taxonomy_id' => $category
					];
				}
			}


			$post_tags = [];

			if (!empty($tags)) {
				foreach (explode(',', $tags) as $tag) {

					$tag = ltrim($tag);

					$is_tag_exist = $this->is_tag_exist($tag);

					if ( ! $is_tag_exist ) {

						$this->db->insert('klik_terms', [
							'name' => $tag
						]);
						$term_id = $this->db->insert_id();

						$this->db->insert('klik_term_taxonomy', [
							'term_id' => $term_id,
							'taxonomy' => 'tag'
						]);
						$taxonomy_id = $this->db->insert_id();

						$post_tags[] = [
							'object_id' => $post_id,
							'term_taxonomy_id' => $taxonomy_id
						];

					} else {
						$post_tags[] = [
							'object_id' => $post_id,
							'term_taxonomy_id' => $is_tag_exist
						];
					}
				}
			}


			if ( count($post_categories) > 0 ) {
				$this->db->insert_batch('klik_term_relationships', $post_categories);
			}

			if ( count($post_tags) > 0 ) {
				$this->db->insert_batch('klik_term_relationships', $post_tags);
			}

			$this->db->where([
				'post_id' => $post_id,
				'meta_key' => 'featured_image'
			])->update('klik_postmeta', [
				'meta_value' => $meta['featured_image']
			]);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	private function is_tag_exist($tag)
	{
		$sql = $this->db->select('tt.term_taxonomy_id')
						 ->from('klik_term_taxonomy tt')
						 ->join('klik_terms t', 't.term_id = tt.term_id')
						 ->where([
						 	'tt.taxonomy' => 'tag',
						 	't.name' => $tag
						 ])->get();
		if ($sql->num_rows() > 0) {
			return $sql->row()->term_taxonomy_id;
		}

		return false;
	}

	public function create_category($data)
	{	

		$this->db->trans_begin();

			$this->db->insert('klik_terms', [
				'name' => $data['category'],
				'slug' => $data['slug']
			]);

			$term_id = $this->db->insert_id();

			$this->db->insert('klik_term_taxonomy', [
				'term_id' => $term_id,
				'taxonomy' => 'category',
				'description' => $data['description'],
				'parent' => $data['parent']
			]);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function update_category($id, $data)
	{		
		$this->db->trans_begin();

			$term_id = $this->db->select('term_id')->get_where('klik_term_taxonomy', [
				'term_taxonomy_id' => $id
			])->row()->term_id;

			$this->db->where('term_taxonomy_id', $id)
					 ->update('klik_term_taxonomy', [
					 	'description' => $data['description'],
					 	'parent' => $data['parent']
					 ]);
			$this->db->where('term_id', $term_id)
					 ->update('klik_terms', [
					 	'name' => $data['category'],
					 	'slug' => $data['slug']
					 ]);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function update_tag($id, $data)
	{		
		$this->db->trans_begin();

			$term_id = $this->db->select('term_id')->get_where('klik_term_taxonomy', [
				'term_taxonomy_id' => $id
			])->row()->term_id;

			$this->db->where('term_taxonomy_id', $id)
					 ->update('klik_term_taxonomy', [
					 	'description' => $data['description']
					 ]);
			$this->db->where('term_id', $term_id)
					 ->update('klik_terms', [
					 	'name' => $data['tag'],
					 	'slug' => $data['slug']
					 ]);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function category_delete($id)
	{
		$this->db->trans_begin();

			$term_id = $this->db->select('term_id')->get_where('klik_term_taxonomy', [
				'term_taxonomy_id' => $id
			])->row()->term_id;

			$this->db->where('term_taxonomy_id', $id)
					 ->delete('klik_term_taxonomy');
			$this->db->where('term_id', $id)
					 ->delete('klik_terms');

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function tag_delete($id)
	{
		$this->db->trans_begin();

			$term_id = $this->db->select('term_id')->get_where('klik_term_taxonomy', [
				'term_taxonomy_id' => $id
			])->row()->term_id;

			$this->db->where('term_taxonomy_id', $id)
					 ->delete('klik_term_taxonomy');
			$this->db->where('term_id', $id)
					 ->delete('klik_terms');

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function create_tag($data)
	{	
		$this->db->trans_begin();

			$this->db->insert('klik_terms', [
				'name' => $data['tag'],
				'slug' => $data['slug']
			]);

			$term_id = $this->db->insert_id();

			$this->db->insert('klik_term_taxonomy', [
				'term_id' => $term_id,
				'taxonomy' => 'tag',
				'description' => $data['description']
			]);

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function get_detail_by_id($id)
	{
		$sql = $this->db->select('p.*, pm.meta_value as featured_image, group_concat(t1.name) as tags, group_concat(tt2.term_taxonomy_id SEPARATOR "|") as category')
						->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key = "featured_image"', 'left')
						->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
						->join('klik_term_taxonomy tt1', 'tt1.term_taxonomy_id = tr.term_taxonomy_id and tt1.taxonomy = "tag"', 'left')
						->join('klik_terms t1', 'tt1.term_id = t1.term_id', 'left')

						->join('klik_term_taxonomy tt2', 'tt2.term_taxonomy_id = tr.term_taxonomy_id and tt2.taxonomy = "category"', 'left')
						->get_where('klik_posts p', [
							'p.post_id' => $id
						]);
		
		return $sql->row();
	}	

	public function trash($post_id)
	{
		$this->db->where('post_id', $post_id)
				 ->update('klik_posts', [
				 	'deleted_on' => date('Y-m-d H:i:s'),
				 	'status' => 'trash'
				 ]);
		return $this->db->affected_rows();
	}

	public function restore($post_id)
	{
		$this->db->where('post_id', $post_id)
				 ->update('klik_posts', [
				 	'deleted_on' => null,
				 	'status' => 'publish'
				 ]);
		return $this->db->affected_rows();
	}

	public function delete($post_id)
	{
		$this->db->trans_begin();

			$this->db->where('post_id', $post_id)->delete('klik_posts');
			$this->db->where('post_id', $post_id)->delete('klik_postmeta');
			$this->db->where('object_id', $post_id)->delete('klik_term_relationships');

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}
}