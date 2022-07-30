<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Media extends AdminController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MediaModel', 'media');
	}

	public function load_modal_media()
	{
		$data['images'] = $this->media->get();

		$this->load->view('themes/'.$this->theme.'/media/load_modal_media', $data);
	}

	public function library()
	{
		$this->template->admin($this->theme, '/media/library');
	}

	public function create()
	{
		$this->template->admin($this->theme, '/media/create');
	}

	public function upload()
	{
		$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

		if (!is_dir($path)) {
			mkdir($path, 0755, true);
		}

		$config['upload_path']   = $path;
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
        	$nama = $this->upload->data('file_name');
        	$mime = $this->upload->data('file_type');

			$this->resizeImage(date('Y') .'/'.date('m').'/', $nama);

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

        	$this->media->insert($data);
        }
	}

	public function summernote_upload()
	{

		$path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

		if (!is_dir($path)) {
			mkdir($path, 0755, true);
		}

		$config['upload_path']   = $path;
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $config['max_size']		 = 1500;
        $this->load->library('upload',$config);

        if($this->upload->do_upload('file')){
        	$nama = $this->upload->data('file_name');
        	$mime = $this->upload->data('file_type');

        	$response = [
        		'status' => true,
        		'url' => base_url("assets/uploads/". date('Y') .'/'.date('m').'/'. $nama)
        	];
        } else {

        	$response = [
        		'status' => false,
        		'message' => $this->upload->display_errors() . ' Allow upload file size 1500kb'
        	];
        }

        echo json_encode($response);
	}

	public function get_media()
	{
		$images = $this->media->get();
		$html = '';

		foreach($images as $image){
			$html .= '<div class="radio img-radio" style="padding: 2px;">
	                    <label>
	                      <input class="custom-img-radio" type="radio" name="image" value="'.$image->guid.'">
	                      <img class="img-list" src="'.base_url('assets/uploads/'. $image->guid).'">
	                    </label>
	                  </div>';
		}

		echo $html;	
	}

	public function gallery()
	{
		$this->load->library('pagination');

        $total_records = $this->media->gallery_total();

        $config['base_url'] = site_url() . 'admin/media/gallery';
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

		$data['gallery'] = $this->media->gallery($config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();
		$this->template->admin($this->theme, 'media/gallery/index', $data);
	}

	public function gallery_create()
	{

		$this->template->admin($this->theme, 'media/gallery/create');
	}

	public function gallery_save()
	{
		
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ){

			if ($this->input->post('_method') == 'PUT' ) {

				$id = $this->input->post('id');

				$this->db->where('gallery_header_id', $id)->update('klik_gallery_header', [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_on' => date('Y-m-d H:i:s')
				]);

				echo json_encode([
					'status' => true,
					'update' => true,
					'pesan' => 'Gallery updated successfully'
				]);

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

							$nama = date('Y') .'/'.date('m').'/'.$this->upload->data('file_name');

							$this->db->insert('klik_gallery', [
								'gallery_header_id' => $id,
								'image' => $nama
							]);

						endif;
					endfor;
				}
				
			} else {
				$this->db->insert('klik_gallery_header', [
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_on' => date('Y-m-d H:i:s')
				]);

				$id = $this->db->insert_id();

				$this->load->library('upload');
				$number_of_files_uploaded = count($_FILES['images']['name']);

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

						$nama = date('Y') .'/'.date('m').'/'.$this->upload->data('file_name');

						$this->db->insert('klik_gallery', [
							'gallery_header_id' => $id,
							'image' => $nama
						]);

					endif;
				endfor;

				echo json_encode([
					'status' => true,
					'pesan' => 'Gallery save successfully',
					'data' => $this->upload->data()
				]);
			}
		}
	}

	public function gallery_delete()
	{
		if ($this->input->is_ajax_request()) {
			if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

				$del = $this->db->where('gallery_header_id', $this->input->post('id'))
						 		->delete('klik_gallery_header');

				$gallery = $this->db->get_where('klik_gallery', ['gallery_header_id' => $this->input->post('id')])->result();

				foreach($gallery as $a) {
					@unlink('./assets/uploads/' . $a->image);
					@unlink('./assets/uploads/thumbnail/' . $a->image);
				} 

				$this->db->where('gallery_header_id', $this->input->post('id'))
						 		->delete('klik_gallery');
				
				if ($del) {
					$response = [
						'status' => true,
						'pesan' => 'Gallery successfully deleted',
						'total' => $this->media->gallery_total()	
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

	public function gallery_edit($id)
	{
		$data['gallery'] = $this->db->get_where('klik_gallery_header', [
			'gallery_header_id' => $id
		])->row();

		$this->template->admin($this->theme, 'media/gallery/create', $data);
	}

	public function detail_image_gallery()
	{
		if ( $this->input->is_ajax_request()) {
			$data['images'] = $this->db->get_where('klik_gallery', [
				'gallery_header_id' => $this->input->get('id')
			])->result();

			$data['gallery'] = $this->db->get_where('klik_gallery_header', [
				'gallery_header_id' => $this->input->get('id')
			])->row();
	
			$this->load->view('themes/' . $this->theme . '/media/gallery/detail_image', $data);
		}
	}

	public function gallery_delete_image()
	{
		if ($this->input->is_ajax_request()) {
			
			$id = $this->input->post('id');
			
			$image = $this->db->get_where('klik_gallery', ['gallery_id' => $id])->row();

			@unlink('./assets/uploads/' . $image->image);
			@unlink('./assets/uploads/thumbnail/' . $image->image);

			$this->db->where('gallery_id', $id)
					->delete('klik_gallery');
			
		}
		
	}
}