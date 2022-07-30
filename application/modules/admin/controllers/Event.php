<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Event extends AdminController 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('EventModel', 'event');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{	
		$this->load->library('pagination');

		$type = $this->input->get('type');
		$data['count'] = $this->event->count_event_by_status();
        $total_records = $this->event->get_total_by_type($type);

        if ( ! empty($type) ) {
        	$config['base_url'] = site_url() . 'admin/event/all?type='.$type;
        } else {
        	$config['base_url'] = site_url() . 'admin/event/all';
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

    	$event_num = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$data['events'] = $this->event->all($type, $config["per_page"], $event_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, 'event/all', $data);
	}

	public function create($id=null)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = [
				'author' => $this->session->user->user_id,
				'status' => $this->input->post('post_status'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'slug' => str_slug($this->input->post('title')),
				'post_parent' => $this->input->post('post_parent'),
				'post_type' => 'event',
				'modified_on' => date('Y-m-d H:i:s'),
			];

			$meta = [
				'featured_image' => $this->input->post('featured_image')
			];

			if ( empty($this->input->post('post_id')) ) {

				$insert = $this->event->create($data,$meta);

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Event successfully published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
	 				];
				}

			} else {
				$update = $this->event->update(
					$this->input->post('post_id'),
					$data,
					$meta
				);

				if ($update) {
					$response = [
						'update' => true,
						'status' => true,
						'pesan' => 'Event successfully updated and published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong when updating your post'
	 				];
				}
			}
			
			$response['parent'] = $this->event->get_event_parent();

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
				$data['event'] = $this->event->get_detail_by_id($id);
			}

			$data['event_parent'] = $this->event->get_event_parent();

			$this->template->admin($this->theme, 'event/create', $data);
			
		}
	}

	public function trash()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->event->trash($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Event successfully added to trash'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->event->count_event_by_status();

		echo json_encode($response);
	}

	public function restore()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->event->restore($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Event restore successfully'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->event->count_event_by_status();

		echo json_encode($response);
	}

	public function delete()
	{
		$post_id = $this->input->post('post_id');

		$delete = $this->event->delete($post_id);

		if ($delete){
			$response = [
				'status' => true,
				'pesan' => 'Event successfully deleted'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->event->count_event_by_status();

		echo json_encode($response);
	}
}