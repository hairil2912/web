<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function cekUsername($username)
    {
        return $this->db->get_where('klik_users', [
            'username' => $username 
        ])->num_rows();
    }

    public function authenticate($username, $password)
    {

        $user = $this->db->get_where('klik_users', [
            'username' => $username
        ])->row();

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            } 
        }

        return false;
    }
}