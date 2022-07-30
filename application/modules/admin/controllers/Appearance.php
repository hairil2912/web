<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Appearance extends AdminController
{	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AppearanceModel', 'appearance');
		if ($this->session->user->level != 0) {
			die();
		}
	}

	public function themes()
	{

	}

	public function menu()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

			$response = [
				'status' => false,
				'pesan' => 'Oops something went wrong'
			];

			if ($this->input->post('_method') == 'PUT') {

				$data = [
					'title' => $this->input->post('menu'),
					'guid' => $this->input->post('link'),
					'slug' => str_slug($this->input->post('menu'))	
				];

				$update = $this->db->where('post_id', $this->input->post('post_id'))
								   ->update('klik_posts', $data);

				if ($update) {
					$response = [
						'status' => true,
						'pesan' => 'Menu successfully updated'
					];
				}

			} else {
				$menu_order = $this->db->select('max(menu_order) as menu_order')
									->from('klik_posts')
									->where([
											'post_type' => 'menu'
									])->get()->row();
				$data = [
					'title'      => $this->input->post('menu'),
					'guid'       => $this->input->post('link'),
					'slug'	     => str_slug($this->input->post('menu')),
					'menu_order' => $menu_order->menu_order+1,
					'post_parent'=> $this->input->post('parent'),
					'post_type'	 => 'menu'
				];
			
				$insert = $this->appearance->menu_insert($data);

				if ($insert) {
					$response = [
						'status' => true,
						'pesan' => 'Successfully added a new menu'
					];
				}
			}

			echo json_encode($response);

		} else {

			$data['menus'] = $this->get_menus();
			$data['pages'] = $this->appearance->get_pages();

			$this->template->admin($this->theme, 'appearance/menu', $data);
		}

	}

	private function get_menus()
	{
		$menus = $this->db->select('post_id, title, menu_order')
						  ->order_by('menu_order', 'asc')
						  ->get_where('klik_posts', [
						  	'post_type' => 'menu',
						  	'status' => 'publish'
						  ])->result();
		return $menus;
	}

	public function fetch_menus()
	{		
		echo '<option value="0">--Menu Parent--</option>';

		foreach($this->get_menus() as $menu) {
			echo '<option value="'.$menu->post_id.'">'.$menu->title.'</option>';
		}
	}

	public function fetch_menus_tree()
	{
		echo get_menus();
	}

	public function delete_menu()
	{
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
			$this->db->where('post_id', $this->input->post('post_id'))
					 ->delete('klik_posts');

			echo json_encode([
				'status' => true,
				'pesan' => 'Menu successfully deleted'
			]);
		}
	}

	public function get_detail_menu($post_id)
	{
		$menu = $this->db->get_where('klik_posts', [
			'post_id' => $post_id
		])->row();

		echo '
			<div class="form-group">
				<label for="menu">Menu</label>
				<input type="text" value="'.$menu->title.'" name="menu" class="form-control" placeholder="Menu">
			</div>
			<div class="form-group">
				<label for="menu">Url</label>
				<input type="text" value="'.$menu->guid.'" name="link" class="form-control" placeholder="Url">
			</div>
			<input type="hidden" name="post_id" id="post_id" value="'.$menu->post_id.'">
			<input type="hidden" name="_method" value="PUT">
		';
	}

	public function add_multiple_menu_by_page()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$menus = [];

			foreach($this->input->post('ids') as $post_id) {

				$menu_order = $this->db->select('max(menu_order) as menu_order')
									->from('klik_posts')
									->where([
											'post_type' => 'menu'
									])->get()->row();
				
				$page = $this->db->get_where('klik_posts', [
					'post_id' => $post_id
				])->row();

				$data = [
					'title'      => $page->title,
					'guid'       => site_url('page/' . $page->slug),
					'slug'	     => str_slug($page->title),
					'menu_order' => $menu_order->menu_order+1,
					'post_parent'=> 0,
					'post_type'	 => 'menu'
				];
			
				$insert = $this->appearance->menu_insert($data);

			}

			echo json_encode([
				'status' => true,
				'pesan' => 'Pages successfully added to menus'
			]);
		}
	}

	public function save_menu_structure()
	{	
		if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

			foreach($this->input->post('menus') as $key => $menu) {

				if (array_key_exists("children", $menu)) {

					foreach($menu['children'] as $child) {


						if (array_key_exists("children", $child)) {

							foreach($child['children'] as $c) {
		
								$this->db->where('post_id', $c['id'])
										 ->update('klik_posts', [
											'post_parent' => $child['id'],
										 ]);
							}
		
							$this->db->where('post_id', $child['id'])
										 ->update('klik_posts', [
											'post_parent' => $menu['id'],
										 ]);
		
						} else {
							$this->db->where('post_id', $child['id'])
								 ->update('klik_posts', [
									'menu_order' => $key,
									'post_parent' => 0
								 ]);
						}


						$this->db->where('post_id', $child['id'])
								 ->update('klik_posts', [
									'post_parent' => $menu['id'],
								 ]);
					}

					$this->db->where('post_id', $menu['id'])
								 ->update('klik_posts', [
									'post_parent' => 0,
								 ]);

				} else {
					$this->db->where('post_id', $menu['id'])
						 ->update('klik_posts', [
							'menu_order' => $key,
							'post_parent' => 0
						 ]);
				}

			}
		}

		echo json_encode([
			$this->input->post('menus')
		]);
	}
}