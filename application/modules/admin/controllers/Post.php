<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Post extends AdminController
{

	private $category_perpage = 7;
	private $tag_perpage = 7;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostModel', 'post');
		$this->load->library('Ajax_pagination');
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{	
		$this->load->library('pagination');

		$type = $this->input->get('type');
		$data['count'] = $this->post->count_post_by_status();
        $total_records = $this->post->get_total_by_type($type);

        if ( ! empty($type) ) {
        	$config['base_url'] = site_url() . 'admin/post/all?type='.$type;
        } else {
        	$config['base_url'] = site_url() . 'admin/post/all';
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

		$data['posts'] = $this->post->all($type, $config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, 'post/all', $data);
	}

	public function create($id=null)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = [
				'author' => $this->session->user->user_id,
				'status' => $this->input->post('post_status'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
				'excerpt' => $this->input->post('excerpt'),
				'slug' => str_slug($this->input->post('title')),
				'modified_on' => date('Y-m-d H:i:s'),
			];

			$meta = [
				'featured_image' => $this->input->post('featured_image')
			];

			if ( empty($this->input->post('post_id')) ) {

				$insert = $this->post->create(
					array_merge($data, [
						'created_on' => date('Y-m-d H:i:s')
					]), 
					$this->input->post('categories'), 
					$this->input->post('tags'),
					$meta
				);

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Post successfully published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
	 				];
				}

			} else {
				$update = $this->post->update(
					$this->input->post('post_id'),
					$data, 
					$this->input->post('categories'), 
					$this->input->post('tags'),
					$meta
				);

				if ($update) {
					$response = [
						'update' => true,
						'status' => true,
						'pesan' => 'Post successfully updated and published'
	 				];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong when updating your post'
	 				];
				}
			}

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

			if ( ! empty($id) ) {
				$data['post'] = $this->post->get_detail_by_id($id);
			}

			$data['categories'] = $this->post->get_post_categories();

			$this->template->admin($this->theme, 'post/create', $data);
			
		}
	}

	public function category($action = null)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$response = [];

			$data = [
				'category' => $this->input->post('category'),
				'slug' => str_slug($this->input->post('category')),
				'description' => $this->input->post('description'),
				'parent' => (!empty($this->input->post('category_parent'))) ? $this->input->post('category_parent') : 0
			];

			if ( empty($this->input->post('id')) ) {
				$insert = $this->post->create_category($data);

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Category data saved successfully',
						'data' => $this->post->get_post_categories()
					];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
					];
				}

			} else {
				$update = $this->post->update_category($this->input->post('id'), $data);

				if ($update) {
					$response = [
						'status' => true,
						'pesan' => 'Category data updated successfully',
						'data' => $this->post->get_post_categories()
					];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
					];
				}

			}

			echo json_encode($response);

		} else {

        	$totalRec = count($this->post->get_post_categories());
        
	        $config['target']      = '#category_lists';
	        $config['base_url']    = site_url().'admin/post/category_ajax/';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->category_perpage;

	        $this->ajax_pagination->initialize($config);
	        
	        $data['categories'] = $this->post->get_post_categories(['limit'=>$this->category_perpage]);
	        $data['categories_parent'] = $this->post->get_post_categories();
			$this->template->admin($this->theme, 'post/category', $data);
		}
	}

	public function category_ajax()
	{	
		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $data = [];
        
        $totalRec = count($this->post->get_post_categories());
        
        $config['target']      = '#category_lists';
        $config['base_url']    = site_url().'admin/post/category_ajax/';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->category_perpage;

        $this->ajax_pagination->initialize($config);

        $data['categories'] = $this->post->get_post_categories(['start'=>$offset,'limit'=>$this->category_perpage]);
		$this->load->view('themes/'.$this->theme.'/post/category_ajax', $data);
	}

	public function category_edit()
	{
		$category = $this->post->category_detail($this->input->post('id'));

		echo json_encode($category);
	}

	public function category_delete()
	{
		$id = $this->input->post('id');

		$delete = $this->post->category_delete($id);

		if ($delete){
			$response = [
				'status' => true,
				'pesan' => 'Category data successfully deleted',
				'data' => $this->post->get_post_categories()
			];
		} else {
			$response = [
				'status' => true,
				'pesan' => 'Oops something went wrong'
			];
		}

		echo json_encode($response);
	}

	public function get_category()
	{
		$categories = $this->post->get_post_categories();
		
		echo json_encode($categories);
	}

	public function tag($action = null)
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$data = [
				'tag' => $this->input->post('tag'),
				'description' => $this->input->post('description'),
				'slug' => str_slug($this->input->post('slug'))
			];

			if ( empty($this->input->post('id')) ) {
				$insert = $this->post->create_tag($data);

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Tag data saved successfully'
					];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
					];
				}

			} else {
				$update = $this->post->update_tag($this->input->post('id'), $data);

				if ($update) {
					$response = [
						'status' => true,
						'pesan' => 'Tag data updated successfully'
					];
				} else {
					$response = [
						'status' => false,
						'pesan' => 'Oops something went wrong'
					];
				}

			}

			echo json_encode($response);

		} else {

			$totalRec = count($this->post->get_post_tags());
        
	        $config['target']      = '#tag_lists';
	        $config['base_url']    = site_url().'admin/post/tag_ajax/';
	        $config['total_rows']  = $totalRec;
	        $config['per_page']    = $this->tag_perpage;

	        $this->ajax_pagination->initialize($config);
	        
	        $data['tags'] = $this->post->get_post_tags(['limit'=>$this->tag_perpage]);

			$this->template->admin($this->theme, 'post/tag', $data);
		}

	}

	public function tag_ajax()
	{	
		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $data = [];
        
        $totalRec = count($this->post->get_post_tags());
        
        $config['target']      = '#tag_lists';
        $config['base_url']    = site_url().'admin/post/tag_ajax/';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->tag_perpage;

        $this->ajax_pagination->initialize($config);

        $data['tags'] = $this->post->get_post_tags(['start'=>$offset,'limit'=>$this->tag_perpage]);
		$this->load->view('themes/'.$this->theme.'/post/tag_ajax', $data);
	}

	public function tag_edit()
	{
		$tag = $this->post->tag_detail($this->input->post('id'));

		echo json_encode($tag);
	}

	public function tag_delete()
	{
		$id = $this->input->post('id');

		$delete = $this->post->tag_delete($id);

		if ($delete){
			$response = [
				'status' => true,
				'pesan' => 'Tag data successfully deleted',
			];
		} else {
			$response = [
				'status' => true,
				'pesan' => 'Oops something went wrong'
			];
		}

		echo json_encode($response);
	}

	public function trash()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->post->trash($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Post successfully added to trash'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->post->count_post_by_status();

		echo json_encode($response);
	}

	public function restore()
	{
		$post_id = $this->input->post('post_id');

		$trash = $this->post->restore($post_id);

		if ($trash) {
			$response = [
				'status' => true,
				'pesan' => 'Post restore successfully'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->post->count_post_by_status();

		echo json_encode($response);
	}

	public function delete()
	{
		$post_id = $this->input->post('post_id');

		$delete = $this->post->delete($post_id);

		if ($delete){
			$response = [
				'status' => true,
				'pesan' => 'Post successfully deleted'
			];
		} else {
			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];
		}

		$response['count'] = $this->post->count_post_by_status();

		echo json_encode($response);
	}
}