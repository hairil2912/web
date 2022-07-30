<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Service extends AdminController 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ServiceModel', 'service');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{	
		$this->load->library('pagination');

		$type = $this->input->get('type');
		$data['count'] = $this->service->count_post_by_status();
        $total_records = $this->service->get_total_by_type($type);

        if ( ! empty($type) ) {
        	$config['base_url'] = site_url() . 'admin/service/all?type='.$type;
        } else {
        	$config['base_url'] = site_url() . 'admin/service/all';
        }

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

		$data['pages'] = $this->service->all($type, $config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, 'service/all', $data);
	}

	public function create($id=null)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = [
				'status' => $this->input->post('post_status'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'slug' => str_slug($this->input->post('title')),
				'post_parent' => $this->input->post('post_parent'),
				'post_type' => 'service',
				'modified_on' => date('Y-m-d H:i:s'),
			];

			$meta = [
				'featured_image' => $this->input->post('featured_image')
			];

			if ( empty($this->input->post('post_id')) ) {

				$insert = $this->service->create($data,$meta);

				$this->load->library('upload');
				$number_of_files_uploaded = count($_FILES['images']['name']);
				
				if ($number_of_files_uploaded > 0){
					$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

					if (!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					// Faking upload calls to $_FILE
					for ($i = 0; $i < $number_of_files_uploaded; $i++) :
						$_FILES['userfile']['name']     = $_FILES['images']['name'][$i];
						$_FILES['userfile']['type']     = $_FILES['images']['type'][$i];
						$_FILES['userfile']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
						$_FILES['userfile']['error']    = $_FILES['images']['error'][$i];
						$_FILES['userfile']['size']     = $_FILES['images']['size'][$i];
						$config = array(
							'allowed_types' => 'jpg|jpeg|png|gif',
							'upload_path' => $path,
							'encrypt_name' => true
						);
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('userfile')) :
							
						else :
							
							$this->resizeImage(date('Y') .'/'.date('m').'/', $this->upload->data('file_name'));

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

				        	$image_id = $this->service->insert_attachment($data);

				        	$this->db->insert('klik_postmeta', [
				        		'post_id' => $insert,
				        		'meta_key' => 'service_attachment',
				        		'meta_value' => $image_id
				        	]);

						endif;
					endfor;
				}

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Service successfully published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
	 				];
				}

			} else {
				$update = $this->service->update(
					$this->input->post('post_id'),
					$data,
					$meta
				);

				if ($update) {
					$response = [
						'update' => true,
						'status' => true,
						'pesan' => 'Service successfully updated and published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong when updating your post'
	 				];
				}
			}
			
			$response['parent'] = $this->service->get_page_parent();

			echo json_encode($response);

		} else {

			add_css([
				'assets/admin/src/vendors/summernote/summernote.css',
				'assets/admin/src/vendors/summernote/summernote-lite.css',
				'assets/admin/src/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css',
				'assets/admin/src/vendors/dropzone.css'
			]);

			add_js([
				'assets/admin/src/vendors/summernote/summernote.min.js',
				'assets/admin/src/vendors/summernote/summernote-lite.js',
				'assets/admin/src/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js',
				'assets/admin/src/vendors/dropzone.js'
			]);
			$data = [];
			if ( ! empty($id) ) {
				$data['page'] = $this->service->get_detail_by_id($id);
			}

			$data['page_parent'] = $this->service->get_page_parent();

			$this->template->admin($this->theme, 'service/create', $data);
			
		}
	}

	public function trash()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->service->trash($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Service successfully added to trash'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->service->count_post_by_status();

		echo json_encode($response);
	}

	public function restore()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->service->restore($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Service restore successfully'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->service->count_post_by_status();

		echo json_encode($response);
	}

	public function delete()
	{
		$post_id = $this->input->post('post_id');

		$delete = $this->service->delete($post_id);

		if ($delete){
			$response = [
				'status' => true,
				'pesan' => 'Service successfully deleted'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->service->count_post_by_status();

		echo json_encode($response);
	}
}