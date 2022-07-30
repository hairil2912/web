<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class EventModel extends CI_Model
{
	public function count_event_by_status()
	{
		$sql = $this->db->query("select
			sum(if(p.status != 'trash', 1, 0)) as all_post, 
			sum(if(p.status = 'publish', 1, 0)) as publish,
			sum(if(p.status = 'draft', 1, 0)) as draft,
			sum(if(p.status = 'trash', 1, 0)) as trash	 
		from klik_posts p
		where p.post_type = 'event'");

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

		$sql = $this->db->select('p.post_id, p.title, u.fullname as author, p.modified_on')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
							'post_type' => 'event'
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

	public function get_detail_by_id($id)
	{
		$sql = $this->db->select('p.*, pm.meta_value as featured_image')
						->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key = "featured_image"', 'left')
						->get_where('klik_posts p', [
							'p.post_id' => $id
						]);
		
		return $sql->row();
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

		$sql = $this->db->select('p.post_id, p.title, u.fullname as author, p.status, p.modified_on')
						->from('klik_posts p')
						->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
							'post_type' => 'event'
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

	public function create($post_data, $meta)
	{
		$this->db->trans_begin();

			$insert_post = $this->db->insert('klik_posts', $post_data);
			$post_id = $this->db->insert_id();

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

	public function update($post_id, $post_data, $meta)
	{
		$this->db->trans_begin();

			$this->db->where('post_id', $post_id)->update('klik_posts', $post_data);

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

		if ($this->db->trans_status() === FALSE) {
		    $this->db->trans_rollback();
		    return FALSE;
		}

	    $this->db->trans_commit();
		return TRUE;
	}

	public function get_event_parent()
	{
		$sql = $this->db->select('post_id, title')
						->from('klik_posts')
						->where('post_type', 'event')
						->where('deleted_on is null', null, false)
						->order_by('title', 'asc');

		return $sql->get()->result();
	}
}