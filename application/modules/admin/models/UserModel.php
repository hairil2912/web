<?php

class UserModel extends CI_Model
{
	public function get_users($limit, $offset)
	{
		$user = $this->db->limit($limit, $offset)
                             ->get('klik_users');

        return $user->result();
	}

	public function total()
	{
		$user = $this->db->get('klik_users');
                           

		return $user->num_rows();
    }
    
    public function detail($id)
    {
        $user = $this->db->get_where('klik_users', [
                            'user_id' => $id
                    ])->row();

        return $user;
    }
}