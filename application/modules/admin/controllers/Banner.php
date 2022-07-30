<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Banner extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('BannerModel', 'banner');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{
		$this->load->library('pagination');

        $total_records = $this->banner->total();

        $config['base_url'] = site_url() . 'admin/banner/all';
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

		$data['banners'] = $this->banner->all($config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, '/banner/index', $data);
	}

	public function create()
	{
		$this->template->admin($this->theme, 'banner/create');
	}

	public function edit($id)
	{
		if ( !empty($id) ) {

			$data['banner'] = $this->banner->detail($id);

			$this->template->admin($this->theme, 'banner/create', $data);
		}
	}

	public function save()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			if ( $this->input->post('_method') == 'PUT' ) {

				if( $_FILES['banner']['error'] == 0 ) { 

					$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

					if (!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					$config['upload_path']   = $path;
			        $config['allowed_types'] = 'gif|jpg|png|ico';
			        $this->load->library('upload',$config);

			        if($this->upload->do_upload('banner')){

			        	$current_img = $this->db->select('guid')
			        							->get_where('klik_posts', [
			        								'post_id' => $this->input->post('post_id')
			        							])->row();

			        	@unlink('./assets/uploads/'.$current_img->guid);

			        	$this->db->where('post_id', $this->input->post('post_id'))
			        			 ->delete('klik_postmeta');

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

			        	$image_id = $this->banner->insert($data);

			        	$banner = [
							'guid' => date('Y') .'/'.date('m').'/'.$nama,
							'modified_on' => date('Y-m-d H:i:s')
						];

						$this->db->where('post_id', $this->input->post('post_id'))
								 ->update('klik_posts', $banner);

						$this->db->insert('klik_postmeta', [
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'banner_attachment',
							'meta_value' => $image_id
						]);

			        	$response = [
			        		'status' => true,
			        		'pesan' => "Banner updated successfully"
			        	];

			        	echo json_encode($response);

			       	}

				} else {
					$response = [
		        		'status' => false,
		        		'pesan' => "You didn't select image to upload"
		        	];

		        	echo json_encode($response);
				}


			} else {
				$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

				if (!is_dir($path)) {
					mkdir($path, 0777, true);
				}

				$config['upload_path']   = $path;
		        $config['allowed_types'] = 'gif|jpg|png|ico';
		        $this->load->library('upload',$config);

		        if($this->upload->do_upload('banner')){

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

		        	$image_id = $this->banner->insert($data);

		        	$banner = [
						'title' => 'banner',
						'content' => $this->input->post('content'),
						'excerpt' => '',
						'slug' => '',
						'guid' => date('Y') .'/'.date('m').'/'.$nama,
						'post_type' => 'banner',
						'mime_type' => '',
						'created_on' => date('Y-m-d H:i:s'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

					$banner_id = $this->banner->insert($banner);

					$this->db->insert('klik_postmeta', [
						'post_id' => $banner_id,
						'meta_key' => 'banner_attachment',
						'meta_value' => $image_id
					]);

		        	$response = [
		        		'status' => true,
		        		'pesan' => "Banner save successfully"
		        	];

		        	echo json_encode($response);

		       	} else {
		       		$response = [
		        		'status' => false,
		        		'pesan' => "You didn't select image to upload"
		        	];

		        	echo json_encode($response);
		       	}	
			}

		}
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

				$current_img = $this->db->select('guid')
	        							->get_where('klik_posts', [
	        								'post_id' => $this->input->post('post_id')
	        							])->row();

	        	@unlink('./assets/uploads/'.$current_img->guid);

	        	$attachment = $this->db->get_where('klik_postmeta', [
	        		'post_id' => $this->input->post('post_id'),
	        		'meta_key' => 'banner_attachment'
	        	])->row();

				$del = $this->db->where('post_id', $this->input->post('post_id'))
						 		->delete('klik_posts');

				if ($del) {

					$this->db->where('post_id', $attachment->meta_value)
						 		->delete('klik_posts');

					$this->db->where([
		        		'post_id' => $this->input->post('post_id'),
		        		'meta_key' => 'banner_attachment'
		        	])->delete('klik_postmeta');

					
					$response = [
						'status' => true,
						'pesan' => 'Banner successfully deleted',
						'slide_count' => $this->banner->total()
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
}