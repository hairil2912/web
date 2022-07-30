<?php

if ( ! function_exists('get_post_categories') )
{
	function get_post_categories($post_id)
	{
		$CI =& get_instance();

		$CI->db->select('t.name')
				->from('klik_term_relationships tr')
				->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy = "category"', 'left')
				->join('klik_terms t', 'tt.term_id = t.term_id', 'left')
				->where('tr.object_id', $post_id);
		
		return $CI->db->get()->result();
	}
}

if ( ! function_exists('get_post_tags') )
{
	function get_post_tags($post_id)
	{
		$CI =& get_instance();

		$CI->db->select('t.name')
				->from('klik_term_relationships tr')
				->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy = "tag"', 'left')
				->join('klik_terms t', 'tt.term_id = t.term_id', 'left')
				->where('tr.object_id', $post_id);
		
		return $CI->db->get()->result();
	}
}

if ( ! function_exists('get_menus') )
{
	function get_menus($parent=0)
	{
		$ci =& get_instance();

		$menus = $ci->db->select('post_id, title, menu_order')
						  ->order_by('menu_order', 'asc')
						  ->get_where('klik_posts', [
						  	'post_type' => 'menu',
							'status' => 'publish',
							'post_parent' => $parent  
						  ])->result();

		$html = '<ol class="dd-list">';						
	
		foreach($menus as $menu) {
			$html .= '<li class="dd-item dd3-item" data-id="'.$menu->post_id.'">
						<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">
						'.$menu->title.'
							<div class="pull-right">
								<a href="#" class="delete" data-id="'.$menu->post_id.'"><i class="fa fa-trash" style="color: red"></i> </a>
								<a href="#" class="edit" data-id="'.$menu->post_id.'"><i class="fa fa-edit" style="color: green"></i> </a>
							</div>
						</div>
						'.get_menus($menu->post_id).'
					</li>';
		}

		$html .= '</ol>';

		return $html;
	}
}