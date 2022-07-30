<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class AdminController extends BaseController
{
	public $theme = 'default';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->logged_in) {
			redirect('auth/login');
		}
	}

	public function resizeImage($path, $filename, $width=150)
    {
		
		$source_path = FCPATH."assets/uploads/" . $path . $filename;
		$target_path = FCPATH."assets/uploads/thumbnail/" . $path;

		if (!is_dir($target_path)) {
			mkdir($target_path, 0755, true);
		}

		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => $width
		);


		$this->load->library('image_lib');
		// Set your config up
		$this->image_lib->initialize($config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}


		$this->image_lib->clear();
   }
}