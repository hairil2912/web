<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class HomeModel extends CI_Model
{

    public function slide()
    {
        $slide = $this->db->select('p.title, p.content, p.guid, m1.meta_value as text1_color, m2.meta_value as text2_color')
                          ->join('klik_postmeta m1', 'm1.post_id = p.post_id and m1.meta_key = "klik_slide_text1_color"', 'left')
                          ->join('klik_postmeta m2', 'm2.post_id = p.post_id and m2.meta_key = "klik_slide_text2_color"', 'left')
				 		  ->get_where('klik_posts p', [
				 		  	 'p.post_type' => 'slide',
				 		  	 'p.status' => 'publish'
				 		  ])->result();

		return $slide;
    }

    public function post($status)
    {
        $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
                        ->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy="category"', 'left')
                        ->join('klik_terms t', 't.term_id = tt.term_id', 'left')
                        ->limit(5)
                        ->order_by('p.created_on', 'desc')
			            ->where([
                            'p.post_type' => 'post',
                            'p.status' => 'publish'
                        ]);
                        if ($status) {
                           $this->db->where([
                               't.name' => $status
                           ]);
                        }

                        if ($status == 'Berita Rumah Sakit') {
                            $this->db->limit(3);
                        }

                        
        return $this->db->get()->result();
    }

    public function event()
    {
        $event = $this->db->select('p.post_id, p.slug, p.title, p.content, p.slug, p.comment_status, u.fullname as author, p.created_on, pm.meta_value as img')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->limit(6)
                        ->order_by('p.created_on', 'desc')
						->where([
                            'post_type' => 'event',
                            'status' => 'publish'
                        ])->get()->result();
                        
        return $event;
    }

    public function testimoni()
    {
        $testimoni = $this->db->select('p.post_id, pp.meta_value as jobtitle, img.guid as img, p.title, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="klik_testimoni_attachment"', 'left')
                          ->join('klik_posts img', 'img.post_id = pm.meta_value', 'left')
                          ->join('klik_postmeta pp', 'pp.post_id = p.post_id and pp.meta_key="klik_testimoni_jobtitle"', 'left')
                          ->group_by('p.post_id')
				 		  ->get_where('klik_posts p', [
				 		  	 'p.post_type' => 'testimoni',
				 		  	 'p.status' => 'publish'
				 		  ])->result();

		return $testimoni;
    }

    public function post_detail($slug)
    {
        $post = $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
						->where([
                            'p.slug' => $slug,
                            'p.status' => 'publish'
                        ])->get()->row();
        
        return $post;
    }

    public function service()
    {
        $service = $this->db->select('p.*, pm.meta_value as img')
                            ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                            ->get_where('klik_posts p', [
                                'p.post_type' => 'service',
                                'p.status' => 'publish'
                            ])->result();

        return $service;
    }

    public function spesialis()
    {
        $spesialis = $this->db->select('p.post_id, p.title, p.content, p.slug, p.comment_status, p.created_on, pm.meta_value as img')
                            ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                            ->get_where('klik_posts p', [
                                'p.post_type' => 'spesialis',
                                'p.status' => 'publish'
                            ])->result();

        return $spesialis;
    }

    public function team()
    {
		$team = $this->db->select('p.post_id, p4.meta_value as jobtitle, p1.meta_value as facebook, p2.meta_value as twiter, p3.meta_value as gplus, img.guid as img, p.title, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal')
						  ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="klik_team_attachment"')
						  ->join('klik_posts img', 'img.post_id = pm.meta_value')
						  ->join('klik_postmeta p4', 'p4.post_id = p.post_id and p4.meta_key ="klik_team_jobtitle"') 
						  ->join('klik_postmeta p1', 'p1.post_id = p.post_id and p1.meta_key ="klik_team_facebook"', 'left')
						  ->join('klik_postmeta p2', 'p2.post_id = p.post_id and p2.meta_key ="klik_team_twitter"', 'left')
						  ->join('klik_postmeta p3', 'p3.post_id = p.post_id and p3.meta_key ="klik_team_gplus"', 'left')
				 		  ->get_where('klik_posts p', [
				 		  	 'p.post_type' => 'team',
				 		  	 'p.status' => 'publish'
				 		  ])->result();

		return $team;
    }

    public function gallery()
    {
        $gallery = $this->db->get('klik_gallery_header')->result();
        
        return $gallery;
    }

    public function post_category($category, $limit, $offset)
    {
        $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img, t.name as category')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
                        ->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy="category"', 'left')
                        ->join('klik_terms t', 't.term_id = tt.term_id', 'left')
                        ->order_by('p.created_on', 'desc')
                        ->where([
                            'p.post_type' => 'post',
                            'p.status' => 'publish',
                            't.slug' => $category
                        ])
                        ->limit($limit, $offset);
                        

                        
        return $this->db->get()->result();
    }

    public function get_total_by_category($category)
    {
        $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
                        ->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy="category"', 'left')
                        ->join('klik_terms t', 't.term_id = tt.term_id', 'left')
                        ->order_by('p.created_on', 'desc')
                        ->where([
                            'p.post_type' => 'post',
                            'p.status' => 'publish',
                            't.slug' => $category
                        ]);
                        

                        
        return $this->db->get()->num_rows();
    }

    public function category_detail($category)
    {
        return $this->db->get_where('klik_terms', [
            'slug' => $category
        ])->row();
    }

    public function banner()
    {
        return $this->db->limit(1)->order_by('post_id', 'desc')->get_where('klik_posts', [
            'post_type' => 'banner',
            'status' => 'publish'
        ])->result();
    }

    public function dokter_detail($id)
    {
        $dokter = $this->db->select('p.post_id, p4.meta_value as jobtitle, p1.meta_value as facebook, p2.meta_value as twiter, p3.meta_value as gplus, img.guid as img, p.title, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal, p5.meta_value as jadwal')
                          ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="klik_team_attachment"')
                          ->join('klik_posts img', 'img.post_id = pm.meta_value')
                          ->join('klik_postmeta p4', 'p4.post_id = p.post_id and p4.meta_key ="klik_team_jobtitle"') 
                          ->join('klik_postmeta p1', 'p1.post_id = p.post_id and p1.meta_key ="klik_team_facebook"', 'left')
                          ->join('klik_postmeta p2', 'p2.post_id = p.post_id and p2.meta_key ="klik_team_twitter"', 'left')
                          ->join('klik_postmeta p3', 'p3.post_id = p.post_id and p3.meta_key ="klik_team_gplus"', 'left')
                          ->join('klik_postmeta p5', 'p5.post_id = p.post_id and p5.meta_key ="klik_team_jadwal"', 'left')
                          ->get_where('klik_posts p', [
                             'p.post_id' => $id
                          ])->row();

        return $dokter;
    }

    public function dokter_lain($id)
    {
        $dokter = $this->db->select('p.post_id, p4.meta_value as jobtitle, p1.meta_value as facebook, p2.meta_value as twiter, p3.meta_value as gplus, img.guid as img, p.title, p.content, p.guid, date_format(p.created_on, "%d-%m-%Y %H:%i") as tanggal, p5.meta_value as jadwal')
                          ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="klik_team_attachment"')
                          ->join('klik_posts img', 'img.post_id = pm.meta_value')
                          ->join('klik_postmeta p4', 'p4.post_id = p.post_id and p4.meta_key ="klik_team_jobtitle"') 
                          ->join('klik_postmeta p1', 'p1.post_id = p.post_id and p1.meta_key ="klik_team_facebook"', 'left')
                          ->join('klik_postmeta p2', 'p2.post_id = p.post_id and p2.meta_key ="klik_team_twitter"', 'left')
                          ->join('klik_postmeta p3', 'p3.post_id = p.post_id and p3.meta_key ="klik_team_gplus"', 'left')
                          ->join('klik_postmeta p5', 'p5.post_id = p.post_id and p5.meta_key ="klik_team_jadwal"', 'left')
                          ->where('p.post_id !=', $id)
                          ->get('klik_posts p')->result();

        return $dokter;
    }

    public function get_total_post()
    {
        $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
                        ->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy="category"', 'left')
                        ->join('klik_terms t', 't.term_id = tt.term_id', 'left')
                        ->order_by('p.created_on', 'desc')
                        ->where([
                            'p.post_type' => 'post',
                            'p.status' => 'publish'
                        ]);
                        

                        
        return $this->db->get()->num_rows();
    }

    public function all_post($limit, $offset)
    {
        $this->db->select('p.post_id, p.title, p.content, p.slug, u.fullname as author, p.comment_status, p.created_on, pm.meta_value as img, t.name as category')
                        ->from('klik_posts p')
                        ->join('klik_postmeta pm', 'pm.post_id = p.post_id and pm.meta_key="featured_image"', 'left')
                        ->join('klik_users u', 'p.author = u.user_id', 'left')
                        ->join('klik_term_relationships tr', 'tr.object_id = p.post_id', 'left')
                        ->join('klik_term_taxonomy tt', 'tt.term_taxonomy_id = tr.term_taxonomy_id and tt.taxonomy="category"', 'left')
                        ->join('klik_terms t', 't.term_id = tt.term_id', 'left')
                        ->order_by('p.created_on', 'desc')
                        ->where([
                            'p.post_type' => 'post',
                            'p.status' => 'publish'
                        ])
                        ->limit($limit, $offset);
                        
        return $this->db->get()->result();
    }

}