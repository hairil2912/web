<?php (defined('BASEPATH')) OR Exit ('No direct script access allowed');

class LoginModel extends CI_Model
{
	public function get_login($username, $password)
	{
		$cekusername = $this->db->get_where('klik_users', [
			'username' => $username
		]);

		if ($cekusername->num_rows() == 1) {
			$cekpassword = password_verify($password, $cekusername->row()->password);

			if ($cekpassword) {
				return $cekusername->row_array();
			}
			return false;
		}
		return false;

	}
}