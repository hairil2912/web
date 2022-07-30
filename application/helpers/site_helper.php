<?php

if (!function_exists('add_js')) {
	function add_js($add_js)
	{
		$ci = &get_instance();
		$ci->path_js = $add_js;
	}
}
if (!function_exists('add_css')) {
	function add_css($add_css)
	{
		$ci = &get_instance();
		$ci->path_css = $add_css;
	}
}
if (!function_exists('asset_js')) {
	function asset_js()
	{
		$ci = &get_instance();
		$js = '';

		if (!empty($ci->path_js)) {

			foreach ($ci->path_js as $phat_js) {
				$js .= '<script src="' . base_url($phat_js) . '" type="text/javascript"></script>';
			}
		}
		echo $js;
	}
}
if (!function_exists('asset_css')) {
	function asset_css()
	{
		$ci = &get_instance();
		$css = '';
		if (!empty($ci->path_css)) {
			foreach ($ci->path_css as $phat_css) {
				$css .= '<link href="' . base_url($phat_css) . '" rel="stylesheet" type="text/css">';
			}
		}
		echo $css;
	}
}

if (!function_exists('str_slug')) {
	function str_slug($text)
	{
		// replace non letter or digits by -
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		// trim
		$text = trim($text, '-');

		// remove duplicated - symbols
		$text = preg_replace('~-+~', '-', $text);

		// lowercase
		$text = strtolower($text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}
}

if (!function_exists('get_theme')) {
	function get_theme()
	{
		return 'hospital';
	}
}


if (!function_exists('tags_by_post')) {
	function tags_by_post($post_id)
	{
		$CI = &get_instance();

		$CI->db->select('t.name')
			->from('klik_term_relationships tr')
			->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy = "tag"', 'left')
			->join('klik_terms t', 'tt.term_id = t.term_id', 'left')
			->where('tr.object_id', $post_id);

		$data = $CI->db->get()->result_array();

		$tags = '';

		foreach ($data as $key => $tag) {
			if ($tag === end($data)) {
				$tags .= ucfirst($tag['name']);
			} else {
				$tags .= ucfirst($tag['name']) . ', ';
			}
		}

		$return = ltrim($tags, ',');
		return rtrim($return, ',');
	}
}

if (!function_exists('latest_news')) {
	function latest_news($post_id)
	{
		$ci = &get_instance();

		$post = $ci->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.created_on, pm.meta_value as img')
			->from('klik_posts p')
			->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
			->join('klik_users u', 'p.author = u.user_id', 'left')
			->limit(6)
			->order_by('p.created_on', 'desc')
			->where_not_in('p.post_id', $post_id)
			->where([
				'post_type' => 'post',
				'status' => 'publish'
			])->get()->result();

		return $post;
	}
}

if (!function_exists('another_services')) {
	function another_services($post_id)
	{
		$ci = &get_instance();

		$post = $ci->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.created_on, pm.meta_value as img')
			->from('klik_posts p')
			->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
			->join('klik_users u', 'p.author = u.user_id', 'left')
			->limit(6)
			->order_by('p.created_on', 'asc')
			->where_not_in('p.post_id', $post_id)
			->where([
				'post_type' => 'service',
				'status' => 'publish'
			])->get()->result();

		return $post;
	}
}



if (!function_exists('another_events')) {
	function another_events($post_id)
	{
		$ci = &get_instance();

		$post = $ci->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.created_on, pm.meta_value as img')
			->from('klik_posts p')
			->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
			->join('klik_users u', 'p.author = u.user_id', 'left')
			->limit(6)
			->order_by('p.created_on', 'asc')
			->where_not_in('p.post_id', $post_id)
			->where([
				'post_type' => 'event',
				'status' => 'publish'
			])->get()->result();

		return $post;
	}
}

if (!function_exists('another_spesialis')) {
	function another_spesialis($post_id)
	{
		$ci = &get_instance();

		$post = $ci->db->select('p.post_id, p.title, p.content, p.slug, p.created_on, pm.meta_value as img')
			->from('klik_posts p')
			->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
			->limit(6)
			->order_by('p.created_on', 'asc')
			->where_not_in('p.post_id', $post_id)
			->where([
				'post_type' => 'spesialis',
				'status' => 'publish'
			])->get()->result();

		return $post;
	}
}


if (!function_exists('get_categories')) {
	function get_categories()
	{
		$ci = &get_instance();

		$sql = $ci->db->select('tt.term_taxonomy_id, t.name, tt.description, t.slug')
			->from('klik_term_taxonomy tt')
			->join('klik_terms t', 'tt.term_id = t.term_id')
			->where('tt.taxonomy', 'category')
			->order_by('t.name', 'asc');

		return $sql->get()->result();
	}
}

if (!function_exists('get_site_setting')) {
	function get_site_setting($setting)
	{
		$ci = &get_instance();

		$setting = $ci->db->select('setting_value')
			->get_where('klik_settings', [
				'setting_name' => $setting
			])->row();

		return $setting->setting_value;
	}
}

if (!function_exists('get_site_menus')) {
	function get_site_menus($parent = 0)
	{
		$ci = &get_instance();

		$menus = $ci->db->select('post_id, title, menu_order, guid')
			->order_by('menu_order', 'asc')
			->get_where('klik_posts', [
				'post_type' => 'menu',
				'status' => 'publish',
				'post_parent' => $parent
			])->result();
		if ($parent != 0 and count($menus) > 0) {
			$html = '<ul class="sub-menu">';
		} else {
			$html = '';
		}

		foreach ($menus as $menu) {

			$cek_parents = $ci->db->select('post_id, title, menu_order, guid')
				->order_by('menu_order', 'asc')
				->get_where('klik_posts', [
					'post_type' => 'menu',
					'status' => 'publish',
					'post_parent' => $menu->post_id
				])->result();

			if (count($cek_parents) > 0) {
				if (filter_var($menu->guid, FILTER_VALIDATE_URL) === FALSE) {
					$url = site_url($menu->guid);
				} else {
					$url = $menu->guid;
				}
				$html .= '
				<li class="menu-item-has-children"><a href="' . $url . '">' . ucwords($menu->title) . ' 
					</a>' . get_site_menus($menu->post_id) . '
				</li>';

			} else {
				if (filter_var($menu->guid, FILTER_VALIDATE_URL) === FALSE) {
					$url = site_url($menu->guid);
				} else {
					$url = $menu->guid;
				}
				$html .= '<li><a href="' . $url . '">' . ucwords($menu->title) . '</a>' . get_site_menus($menu->post_id) . '</li>';
			}
		}

		if ($parent != 0 and count($menus) > 0) {
			$html .= '</ul>';
		}

		return $html;
	}
}

if (!function_exists('get_images_gallery')) {
	function get_images_gallery($id)
	{
		$ci = &get_instance();

		$gallery = $ci->db->get_where('klik_gallery', [
			'gallery_header_id' => $id
		])->result();

		return $gallery;
	}
}

if (!function_exists('img_thumb')) {
	function img_thumb($img)
	{
		if (empty($img)) {
			return base_url("assets/static-image/no-thumbnail.png");
		} else {

			if (file_exists(FCPATH . "assets/uploads/thumbnail/" . $img)) {
				return base_url("assets/uploads/thumbnail/" . $img);
			} else {
				if (file_exists(FCPATH . "assets/uploads/" . $img)) {
					return base_url("assets/uploads/" . $img);
				} else {
					return base_url("assets/static-image/no-thumbnail.png");
				}
			}
		}
	}
}

if (!function_exists('img_ori')) {
	function img_ori($img)
	{
		if (empty($img)) {
			return base_url("assets/static-image/no-thumbnail.png");
		} else {

			if (file_exists(FCPATH . "assets/uploads/" . $img)) {
				return base_url("assets/uploads/" . $img);
			} else {
				if (file_exists(FCPATH . "assets/uploads/" . $img)) {
					return base_url("assets/uploads/" . $img);
				} else {
					return base_url("assets/static-image/no-thumbnail.png");
				}
			}
		}
	}
}

if (!function_exists('service_attachment')) {
	function service_attachment($service_id)
	{
		$ci = &get_instance();

		$attachment = $ci->db->select('p.guid')
			->join('klik_posts p', 'pm.meta_value = p.post_id')
			->where('pm.post_id', $service_id)
			->from('klik_postmeta pm')
			->get();

		return $attachment->result();
	}
}

if (!function_exists('gallery')) {
	function gallery()
	{
		$ci = &get_instance();

		return $ci->db->order_by('rand()')->limit(9)->get('klik_gallery')->result();
	}
}

if (!function_exists('render_post_excerpt')) {
	function render_post_excerpt($post, $length = 75)
	{
		return substr(preg_replace('/<[^>]*>/', '', $post), 0, $length);
	}
}

if (!function_exists('clear_string')) {
	function clear_string($content, $length = 300)
	{
		if (!empty($content)) {

			$str = str_replace("&nbsp;", "", $content);
			$str = preg_replace('/\s+/', ' ', $str);
			$str = trim($str);
			return substr(strip_tags($str), 0, $length);
		}

		return;
	}
}

if (!function_exists('decrypt')) {
	function decrypt($str)
	{
		$ci = &get_instance();

		return $ci->encryption->decrypt($str);
	}
}

if (!function_exists('encrypt')) {
	function encrypt($str)
	{
		$ci = &get_instance();

		return $ci->encryption->encrypt($str);
	}
}

if (!function_exists('namahari')) {
    function namahari($tanggal)
    {
        $tgl = substr($tanggal, 8, 2);
        $bln = substr($tanggal, 5, 2);
        $thn = substr($tanggal, 0, 4);

        $info = date('w', mktime(0, 0, 0, $bln, $tgl, $thn));

        switch ($info) {
            case '0':
                return 'Minggu';

                break;
            case '1':
                return 'Senin';

                break;
            case '2':
                return 'Selasa';

                break;
            case '3':
                return 'Rabu';

                break;
            case '4':
                return 'Kamis';

                break;
            case '5':
                return 'Jumat';

                break;
            case '6':
                return 'Sabtu';

                break;
        }
    }
}
