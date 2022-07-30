<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class Home extends SiteController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel', 'home');
		$this->load->model('TestimoniModel', 'testimoni');
		$this->load->model('SitemapModel');
	}

	public function index()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_PORT => 80,
			CURLOPT_URL => $this->base_url . "free/master/dokter",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
			),
		));

		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

		$res_dokter = curl_exec($curl);
		$errdokter = curl_error($curl);

		curl_close($curl);

		if ($errdokter) {
			$response = [
				'status' => false,
				'message' => "cURL Error #:" . $errdokter
			];
		} else {
			$res_dokter = json_decode($res_dokter);
		}

		$data['slides']			= $this->home->slide();
		$data['events']			= $this->home->event();
		$data['testimonials']	= $this->home->testimoni();
		$data['services']		= $this->home->service();
		$data['spesialis']		= $this->home->spesialis();
		$data['dokters']		= $res_dokter;
		// print_r($data['dokters']); die;
		$data['banners'] 		= $this->home->banner();
		$data['ip']				= $this->url;

		$this->template->site($this->theme, 'index', $data, function () {
			$this->load->view('themes/' . $this->theme . '/part/slider');
			$this->load->view('themes/' . $this->theme . '/part/layanan_online');
			$this->load->view('themes/' . $this->theme . '/part/berita');
			$this->load->view('themes/' . $this->theme . '/part/spesialis');
			$this->load->view('themes/' . $this->theme . '/part/banner');
			$this->load->view('themes/' . $this->theme . '/part/departements');
			$this->load->view('themes/' . $this->theme . '/part/doktor');
			$this->load->view('themes/' . $this->theme . '/part/testimoni');
			$this->load->view('themes/' . $this->theme . '/part/kegiatan');
		});
	}

	public function detail($slug)
	{
		$data['post'] = $this->home->post_detail($slug);
		if ($data['post']) {
			$this->template->site($this->theme, 'post_detail', $data);
		}
	}

	public function page($slug)
	{
		$data['post'] = $this->home->post_detail($slug);

		if ($data['post']) {
			$this->template->site($this->theme, 'post_detail', $data);
		}
	}

	public function category($category)
	{
		$this->load->library('pagination');

		$total_records = $this->home->get_total_by_category($category);

		$config['base_url'] = site_url() . 'category/' . $category;
		$config['total_rows'] = $total_records;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['page_query_string'] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_link"] = "&laquo;";
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = "</li>";
		$config["last_link"] = "&raquo;";
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = "</li>";
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$page_num = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$data['posts'] = $this->home->post_category($category, $config["per_page"], $page_num);
		$data['category'] = $this->home->category_detail($category);

		$this->pagination->initialize($config);

		// build paging links
		$data["links"] = $this->pagination->create_links();

		$this->template->site($this->theme, 'category', $data);
	}

	public function service($slug)
	{
		$data['post'] = $this->home->post_detail($slug);

		if ($data['post']) {
			$this->template->site($this->theme, 'post_detail', $data);
		}
	}

	public function event($slug)
	{
		$data['post'] = $this->home->post_detail($slug);

		if ($data['post']) {
			$this->template->site($this->theme, 'post_detail', $data);
		}
	}

	public function testimoni()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('pesan', 'Pesan', 'required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

			$this->form_validation->set_message('required', '{field} harus diisi.');

			if ($this->form_validation->run()) {
				if ($_FILES['foto']['error'] == 0) {

					$path = FCPATH . "assets/uploads/" . date('Y') . '/' . date('m') . '/';

					if (!is_dir($path)) {
						mkdir($path, 0777, true);
					}

					$config['upload_path']   = $path;
					$config['allowed_types'] = 'gif|jpg|png|ico';
					$this->load->library('upload', $config);

					if ($this->upload->do_upload('foto')) {
						$nama = $this->upload->data('file_name');
						$mime = $this->upload->data('file_type');

						$data = [
							'title' => $nama,
							'content' => $nama,
							'excerpt' => '',
							'slug' => '',
							'guid' => date('Y') . '/' . date('m') . '/' . $nama,
							'post_type' => 'attachment',
							'mime_type' => $mime,
							'created_on' => date('Y-m-d H:i:s'),
							'modified_on' => date('Y-m-d H:i:s'),
						];

						$image_id = $this->testimoni->insert($data);

						$testimoni = [
							'title' => $this->input->post('nama'),
							'content' => $this->input->post('pesan'),
							'excerpt' => '',
							'slug' => '',
							'status' => 'pending',
							'guid' => date('Y') . '/' . date('m') . '/' . $nama,
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
								'meta_value' => date('Y-m-d')
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
							'pesan' => "Testimoni anda telah kami terima dan akan ditampilkan setelah proses review"
						];
					}
				} else {

					$testimoni = [
						'title' => $this->input->post('nama'),
						'content' => $this->input->post('pesan'),
						'excerpt' => '',
						'slug' => '',
						'status' => 'pending',
						'guid' => '',
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
							'meta_value' => ''
						],
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_testimoni_date',
							'meta_value' => date('Y-m-d')
						],
						[
							'post_id' => $post_id,
							'meta_key' => 'klik_testimoni_jobtitle',
							'meta_value' => ''
						]
					];

					$this->db->insert_batch('klik_postmeta', $meta);

					$response = [
						'status' => true,
						'pesan' => "Testimoni anda telah kami terima dan akan ditampilkan setelah proses review"
					];
				}
			} else {

				$response = [
					'status' => false,
				];

				foreach ($this->input->post() as $key => $value) {
					$response['error'][$key] = form_error($key);
				}
			}

			echo json_encode($response);
		}
	}

	public function sitemap()
	{
		$data['urlslist'] = $this->SitemapModel->getURLS();
		$data['categories'] = $this->SitemapModel->getCategory();
		$data['pages']	= $this->SitemapModel->pages();

		$this->load->view('themes/' . $this->theme . '/sitemap', $data);
	}

	public function posts()
	{
		$this->load->library('pagination');

		$total_records = $this->home->get_total_post();

		$config['base_url'] = site_url('posts');
		$config['total_rows'] = $total_records;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['page_query_string'] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_link"] = "&laquo;";
		$config["first_tag_open"] = '<li>';
		$config["first_tag_close"] = "</li>";
		$config["last_link"] = "&raquo;";
		$config["last_tag_open"] = '<li>';
		$config["last_tag_close"] = "</li>";
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '<li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '<li>';
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$page_num = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$data['posts'] = $this->home->all_post($config["per_page"], $page_num);
		$this->pagination->initialize($config);
		$data["links"] = $this->pagination->create_links();
		$this->template->site($this->theme, 'all_posts', $data);
	}}
