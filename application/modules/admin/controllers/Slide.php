<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Slide extends AdminController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SlideModel', 'slide');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{	
		$this->load->library('pagination');

        $total_records = $this->slide->total();

        $config['base_url'] = site_url() . 'admin/slide/all';
        $config['total_rows'] = $total_records;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['page_query_string'] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination pull-right pagination-sm">';
		$config["full_tag_close"] = '</ul>';	
		$config["first_link"] = "&laquo;";
		$config["first_tag_open"] = "<li class='page-item'>";
		$config["first_tag_close"] = "</li>";
		$config["last_link"] = "&raquo;";
		$config["last_tag_open"] = "<li class='page-item'>";
		$config["last_tag_close"] = "</li>";
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = "<li class='page-item'>";
		$config['next_tag_close'] = '<li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = "<li class='page-item'>";
		$config['prev_tag_close'] = '<li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

    	$page_num = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$data['slides'] = $this->slide->all($config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, '/slide/all', $data);
	}

	public function create()
	{	
		$this->template->admin($this->theme, 'slide/create');
	}

	public function save()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			if ($this->input->post('_method') == 'PUT') {
				if( $_FILES['slide']['error'] == 0 ) { 

					$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

					if (!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					$config['upload_path']   = $path;
			        $config['allowed_types'] = 'gif|jpg|png|ico';
			        $this->load->library('upload',$config);

			        if($this->upload->do_upload('slide')){
			        	$nama = $this->upload->data('file_name');
			        	$mime = $this->upload->data('file_type');

			        	$data = [
							'title' => $nama,
							'content' => $nama,
							'excerpt' => '',
							'slug' => '',
							'guid' => date('Y') .'/'.date('m').'/'.$nama,
							'post_type' => 'attachment',
							'mime_type' => $mime,
							'created_on' => date('Y-m-d H:i:s'),
							'modified_on' => date('Y-m-d H:i:s'),
						];

			        	$image_id = $this->slide->insert($data);

			        	$slide = [
							'title' => $this->input->post('text1'),
							'content' => $this->input->post('text2'),
							'excerpt' => '',
							'slug' => '',
							'guid' => date('Y') .'/'.date('m').'/'.$nama,
							'post_type' => 'slide',
							'mime_type' => '',
							'created_on' => date('Y-m-d H:i:s'),
							'modified_on' => date('Y-m-d H:i:s'),
						];

						$this->db->where('post_id', $this->input->post('post_id'))->update('klik_posts', $slide);
			        	$this->db->where([
			        		'post_id' => $this->input->post('post_id'),
			        		'meta_key' => 'klik_slide_attachment'
			        	])->delete('klik_postmeta');
			        	$this->db->where([
			        		'post_id' => $this->input->post('post_id'),
			        		'meta_key' => 'klik_slide_text1_color'
			        	])->delete('klik_postmeta');
			        	$this->db->where([
			        		'post_id' => $this->input->post('post_id'),
			        		'meta_key' => 'klik_slide_text2_color'
			        	])->delete('klik_postmeta');

			        	$metas = [
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_slide_attachment',
								'meta_value' => $image_id
							], 
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_slide_text1_color',
								'meta_value' => $this->input->post('text1_color')
							],
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_slide_text2_color',
								'meta_value' => $this->input->post('text1_color')
							]

						];

			        	$this->db->insert_batch('klik_postmeta', $metas);

			        	$response = [
			        		'status' => true,
			        		'pesan' => "Slide update successfully"
			        	];
			       	} else {
			       		$response = [
			        		'status' => false,
			        		'pesan' => "You didn't select image to upload"
			        	];
			       	}
				} else {
					$slide = [
						'title' => $this->input->post('text1'),
						'content' => $this->input->post('text2'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

					$this->db->where([
		        		'post_id' => $this->input->post('post_id'),
		        		'meta_key' => 'klik_slide_text1_color'
		        	])->delete('klik_postmeta');
		        	$this->db->where([
		        		'post_id' => $this->input->post('post_id'),
		        		'meta_key' => 'klik_slide_text2_color'
		        	])->delete('klik_postmeta');

		        	$metas = [
		        		[
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'klik_slide_text1_color',
							'meta_value' => $this->input->post('text1_color')
						],
						[
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'klik_slide_text2_color',
							'meta_value' => $this->input->post('text2_color')
						]

					];

		        	$this->db->insert_batch('klik_postmeta', $metas);

					$this->db->where('post_id', $this->input->post('post_id'))->update('klik_posts', $slide);
		        	
		        	$response = [
		        		'status' => true,
		        		'update' => true,
		        		'pesan' => "Slide update successfully"
		        	];
				}
			} else {

				$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

				if (!is_dir($path)) {
					mkdir($path, 0777, true);
				}

				$config['upload_path']   = $path;
		        $config['allowed_types'] = 'gif|jpg|png|ico';
		        $this->load->library('upload',$config);

		        if($this->upload->do_upload('slide')){
		        	$nama = $this->upload->data('file_name');
		        	$mime = $this->upload->data('file_type');

		        	$data = [
						'title' => $nama,
						'content' => $nama,
						'excerpt' => '',
						'slug' => '',
						'guid' => date('Y') .'/'.date('m').'/'.$nama,
						'post_type' => 'attachment',
						'mime_type' => $mime,
						'created_on' => date('Y-m-d H:i:s'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

		        	$image_id = $this->slide->insert($data);

		        	$slide = [
						'title' => $this->input->post('text1'),
						'content' => $this->input->post('text2'),
						'excerpt' => '',
						'slug' => '',
						'guid' => date('Y') .'/'.date('m').'/'.$nama,
						'post_type' => 'slide',
						'mime_type' => '',
						'created_on' => date('Y-m-d H:i:s'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

					$post_id = $this->slide->insert($slide);
		        	
					$metas = [
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_slide_attachment',
							'meta_value' => $image_id
						], 
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_slide_text1_color',
							'meta_value' => $this->input->post('text1_color')
						],
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_slide_text2_color',
							'meta_value' => $this->input->post('text2_color')
						]

					];

		        	$this->db->insert_batch('klik_postmeta', $metas);

		        	$response = [
		        		'status' => true,
		        		'pesan' => "Slide save successfully"
		        	];

		        } else {
		        	$response = [
		        		'status' => false,
		        		'pesan' => "You didn't select image to upload"
		        	];
		        }
			}


	        echo json_encode($response);
	    }
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

				$del = $this->db->where('post_id', $this->input->post('post_id'))
						 		->delete('klik_posts');

				if ($del) {
					$this->db->where([
		        		'post_id' => $this->input->post('post_id'),
		        		'meta_key' => 'klik_slide_attachment'
		        	])->delete('klik_postmeta');

					
					$response = [
						'status' => true,
						'pesan' => 'Slide successfully deleted',
						'slide_count' => $this->slide->total()
					];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
					];
				}

				echo json_encode($response);
			}
		}
	}

	public function edit($id)
	{
		if (!empty($id)) {

			$data['slide'] = $this->db->select('p.*, m1.meta_value as text1_color, m2.meta_value as text2_color')
							
							->join('klik_postmeta m1', 'm1.post_id = p.post_id and m1.meta_key = "klik_slide_text1_color"', 'left')
							->join('klik_postmeta m2', 'm2.post_id = p.post_id and m2.meta_key = "klik_slide_text2_color"', 'left')
							->get_where('klik_posts p', [
								'p.post_id' => $id
							])
							->row();

			$this->template->admin($this->theme, 'slide/create', $data);
		}
	}
}