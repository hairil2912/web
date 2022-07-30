<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MediaModel extends CI_Model
{
	public function insert($data)
	{
		$this->db->insert('klik_posts', $data);
	}

	public function get()
	{
		$sql = $this->db->get_where('klik_posts', [
			'post_type' => 'attachment',
			'status' => 'publish'
		]);

		return $sql->result();
	}

	public function gallery($limit, $offset)
    {
        $gallery = $this->db->limit($limit, $offset)
                             ->get('klik_gallery_header');

        return $gallery->result();
    }

    public function gallery_total()
	{
		$gallery = $this->db->get('klik_gallery_header');

        return $gallery->num_rows();
    }
}