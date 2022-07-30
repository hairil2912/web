<?php

class User extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel', 'user');

		if ($this->session->user->level != 0) {
			die();
		}
	}

	public function index()
	{
		$this->all();
	}

	public function all()
	{

		$this->load->library('pagination');

        $total_records = $this->user->total();

        $config['base_url'] = site_url() . 'admin/user/all';
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

		$data['users'] = $this->user->get_users($config["per_page"], $page_num);
         
        $this->pagination->initialize($config);
         
        // build paging links
        $data["links"] = $this->pagination->create_links();

		$this->template->admin($this->theme, 'user/all', $data);
	}

	public function create()
    {
        $this->template->admin($this->theme, 'user/create');
    }

    public function save()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

            
            if ( $this->input->post('_method') == 'PUT' ) {

            	if (empty($this->input->post('password'))) {

					$user = [
		                'username' => $this->input->post('username'),
		                'fullname' => $this->input->post('fullname'),
		                'email' => $this->input->post('email')
		            ];

				} else {
					$user = [
		                'username' => $this->input->post('username'),
		                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
		                'fullname' => $this->input->post('fullname'),
		                'email' => $this->input->post('email')
		            ];
				}

            	$cek_user = $this->db->select('username')->get_where('klik_users', ['user_id' => $this->input->post('user_id')])->row();

            	if ( $this->input->post('username') != $cek_user->username ) {

            		$cek_username = $this->db->get_where('klik_users', ['username' => $this->input->post('username')])->num_rows();

	            	if ( $cek_username > 0 ) {
	            		echo json_encode([
	            			'status' => false,
	            			'pesan' => 'Username yang anda pilih sudah digunakan'
	            		]);
	            		exit();
	            	}

            	}


                $this->db->where('user_id', $this->input->post('user_id'))
                         ->update('klik_users', $user);

                $response = [
                    'status' => true,
                    'update' => true,
                    'pesan' => 'User data updated successfully'
                ];
            } else {

				$user = [
	                'username' => $this->input->post('username'),
	                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
	                'fullname' => $this->input->post('fullname'),
	                'email' => $this->input->post('email'),
	                'level' => 1
	            ];

            	$cek_username = $this->db->get_where('klik_users', ['username' => $this->input->post('username')])->num_rows();

            	if ( $cek_username > 0 ) {
            		echo json_encode([
            			'status' => false,
            			'pesan' => 'Username yang anda pilih sudah digunakan'
            		]);
            		exit();
            	} else {

	                $this->db->insert('klik_users', $user);

	                $response = [
	                    'status' => true,
	                    'pesan' => 'User data saved successfully'
	                ];
            	}

            }


	        echo json_encode($response);
	    }
    }
    
    public function edit($id)
    {
        
        $data['user'] = $this->user->detail($id);

        $this->template->admin($this->theme, 'user/create', $data);
    }

    public function delete()
    {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

        	$cek = $this->db->get_where('klik_users', [
        		'user_id' => $this->input->post('user_id')
        	])->row();

        	if ( $cek->level == 0 ) {
        		echo json_encode([
	                'status' => false,
	                'pesan' => 'Oops you are not allowed to delete super user',
	                'total' => $this->user->total()
	            ]);
	            exit();
        	}

            $this->db->where('user_id', $this->input->post('user_id'))
                    ->delete('klik_users');

            echo json_encode([
                'status' => true,
                'pesan' => 'User data successfully deleted',
                'total' => $this->user->total()
            ]);
        }
    }
}