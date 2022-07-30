<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Testimoni extends AdminController
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('TestimoniModel', 'testimoni');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{	
		$this->load->library('pagination');

        $total_records = $this->testimoni->total();

        $config['base_url'] = site_url() . 'admin/testimoni/all';
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

		$data['testimoni'] = $this->testimoni->all($config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, '/testimoni/index', $data);
	}

	public function create()
	{	
		$this->template->admin($this->theme, 'testimoni/create');
	}

	public function save()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			if ($this->input->post('_method') == 'PUT') {
				if( $_FILES['image']['error'] == 0 ) { 

					$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

					if (!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					$config['upload_path']   = $path;
			        $config['allowed_types'] = 'gif|jpg|png|ico';
			        $this->load->library('upload',$config);

			        if($this->upload->do_upload('image')){
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

			        	$image_id = $this->testimoni->insert($data);

			        	$testimoni = [
							'title' => $this->input->post('name'),
							'content' => $this->input->post('testimoni'),
							'excerpt' => '',
							'slug' => '',
							'guid' => date('Y') .'/'.date('m').'/'.$nama,
							'post_type' => 'testimoni',
							'mime_type' => '',
							'created_on' => date('Y-m-d H:i:s'),
							'modified_on' => date('Y-m-d H:i:s'),
						];

						$this->db->where('post_id', $this->input->post('post_id'))->update('klik_posts', $testimoni);
						
						$this->db->where('post_id', $this->input->post('post_id'))->delete('klik_postmeta');
					
						$meta = [
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_testimoni_attachment',
								'meta_value' => $image_id
							],
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_testimoni_date',
								'meta_value' => $this->input->post('date')
							],
							[
								'post_id' => $this->input->post('post_id'),
								'meta_key' => 'klik_testimoni_jobtitle',
								'meta_value' => $this->input->post('jobtitle')
							]
						];

						$this->db->insert_batch('klik_postmeta', $meta);

			        	$response = [
			        		'status' => true,
			        		'pesan' => "Testimoni update successfully"
			        	];
			       	} else {
			       		$response = [
			        		'status' => false,
			        		'pesan' => "You didn't select image to upload"
			        	];
			       	}
				} else {
					$slide = [
						'title' => $this->input->post('name'),
						'content' => $this->input->post('testimoni'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

					$this->db->where('post_id', $this->input->post('post_id'))->update('klik_posts', $slide);
					$this->db->where('post_id', $this->input->post('post_id'))->delete('klik_postmeta');
					
					$meta = [
						[
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'klik_testimoni_attachment',
							'meta_value' => $this->input->post('image_id')
						],
						[
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'klik_testimoni_date',
							'meta_value' => $this->input->post('date')
						],
						[
							'post_id' => $this->input->post('post_id'),
							'meta_key' => 'klik_testimoni_jobtitle',
							'meta_value' => $this->input->post('jobtitle')
						]
					];

					$this->db->insert_batch('klik_postmeta', $meta);
					
		        	$response = [
		        		'status' => true,
		        		'update' => true,
		        		'pesan' => "Testimoni update successfully"
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

		        if($this->upload->do_upload('image')){
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

		        	$image_id = $this->testimoni->insert($data);

		        	$testimoni = [
						'title' => $this->input->post('name'),
						'content' => $this->input->post('testimoni'),
						'excerpt' => '',
						'slug' => '',
						'guid' => date('Y') .'/'.date('m').'/'.$nama,
						'post_type' => 'testimoni',
						'mime_type' => '',
						'created_on' => date('Y-m-d H:i:s'),
						'modified_on' => date('Y-m-d H:i:s'),
					];

					$post_id = $this->testimoni->insert($testimoni);

					$meta = [
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_testimoni_attachment',
							'meta_value' => $image_id
						],
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_testimoni_date',
							'meta_value' => $this->input->post('date')
						],
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_testimoni_jobtitle',
							'meta_value' => $this->input->post('jobtitle')
						]
					];

					$this->db->insert_batch('klik_postmeta', $meta);

		        	$response = [
		        		'status' => true,
		        		'pesan' => "Testimoni save successfully"
		        	];

		        } else {
		        	$response = [
						'status' => false,
						'error' => $this->upload->display_errors(),
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
		        		'post_id' => $this->input->post('post_id')
		        	])->delete('klik_postmeta');

					
					$response = [
						'status' => true,
						'pesan' => 'Testimoni successfully deleted',
						'testimoni_count' => $this->testimoni->total()
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

			$data['testimoni'] = $this->db->select('p.*, p1.meta_value as image_id, p2.meta_value as date, p3.meta_value as jobtitle')
										  ->join('klik_postmeta p1', 'p1.post_id = p.post_id and p1.meta_key="klik_testimoni_attachment"')
										  ->join('klik_postmeta p2', 'p2.post_id = p.post_id and p2.meta_key="klik_testimoni_date"')
										  ->join('klik_postmeta p3', 'p3.post_id = p.post_id and p3.meta_key="klik_testimoni_jobtitle"')
										  ->get_where('klik_posts p', [
												'p.post_id' => $id
											])->row();

			$this->template->admin($this->theme, 'testimoni/create', $data);
		}
	}

	public function change_status()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$id = $this->input->post('id');

			$this->db->where('post_id', $id)
					 ->update('klik_posts', [
					 	'status' => $this->input->post('status')
					 ]);

			echo json_encode([
				'status' => true,
				'pesan' => 'Status testimoni berhasil diubah'
			]);
		}
	}
}