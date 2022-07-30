<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setting extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel', 'setting');
        if ($this->session->user->level != 0) {
            die();
        }
    }

    public function general()
    {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

            if ( $_FILES['icon']['error'] == 0 ) {

                $path = FCPATH."assets/uploads/". date('Y') .'/'.date('m').'/';

                if (!is_dir($path)) {
                    mkdir($path, 0777, true);
                }

                $config['upload_path']   = $path;
                $config['allowed_types'] = 'gif|jpg|png|ico';
                $this->load->library('upload',$config);

                if($this->upload->do_upload('icon')){
                    $nama = $this->upload->data('file_name');
                    $mime = $this->upload->data('file_type');

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

                    $this->db->insert('klik_posts', $data);

                    $icon = $data['guid'];

                } else {
                    $icon = '';
                }

            } else {
                $icon = $this->input->post('icon_');
            }

            foreach($this->input->post() as $key => $value) {
                if ($key != 'icon_') {
                     $this->setting->cek_setting($key) 
                            ? $this->setting->update_setting($key, $this->input->post($key))
                            : $this->setting->insert_setting($key, $this->input->post($key));
                }
               
            }

            $this->setting->cek_setting('site_icon') 
                    ? $this->setting->update_setting('site_icon', $icon)
                    : $this->setting->insert_setting('site_icon', $icon);

            $response = [
                'status' => true,
                'pesan' => 'General setting successfully updated'  
            ];
            
            echo json_encode($response);
            
        } else {

            $data['setting'] = $this->setting->detail();
            $data['color']   = $this->setting->color();

            $this->template->admin($this->theme, 'setting/general', $data);
        }
    }

    public function socialmedia()
    {
        if ( $_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach($this->input->post() as $key => $value) {
                $this->setting->cek_setting($key) 
                    ? $this->setting->update_setting($key, $this->input->post($key))
                    : $this->setting->insert_setting($key, $this->input->post($key));
            }

            $response = [
                'status' => true,
                'pesan' => 'Social Media setting successfully updated'  
            ];
            
            echo json_encode($response);
            
        } else {

            $data['setting'] = $this->setting->detail_socialmedia();

            $this->template->admin($this->theme, 'setting/socialmedia', $data);
        }
    }

    public function link()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($this->input->post() as $key => $value) {
                $this->setting->cek_link($key)
                ? $this->setting->update_setting($key, $this->input->post($key))
                : $this->setting->insert_setting($key, $this->input->post($key));
            }

            $response = [
                'status' => true,
                'pesan' => 'Link Terkait successfully updated'
            ];

            echo json_encode($response);
        } else {
            $data['link'] = $this->setting->detail_link();
            // print_r($data['link']); die;

            $this->template->admin($this->theme, 'setting/link', $data);
        }
    }
}