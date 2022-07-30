<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Home extends AdminController
{
	public function index()
	{
		// add_js([
		// 	'assets/global/plugins/highcharts/highcharts.js',
		// 	'assets/global/plugins/highcharts/js/modules/exporting.js'
		// ]);

		$this->template->admin($this->theme, 'home/index');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}