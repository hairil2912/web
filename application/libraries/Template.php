<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
	public $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function admin($themes, $view, $data = null)
	{
		$this->ci->load->view('themes/' . $themes . '/master/header', $data);
		$this->ci->load->view('themes/' . $themes . '/master/sidebar', $data);
		$this->ci->load->view('themes/' . $themes . '/master/aside', $data);
		$this->ci->load->view('themes/' . $themes . '/' . $view, $data);
		$this->ci->load->view('themes/' . $themes . '/master/footer', $data);
	}

	public function site($themes, $view = false, $data = null, callable $inject = null)
	{
		$this->ci->load->view('themes/' . $themes . '/master/header', $data);
		if (is_callable($inject)) {
			$inject();
		}
		$this->ci->load->view('themes/' . $themes . '/' . $view, $data);
		$this->ci->load->view('themes/' . $themes . '/master/footer', $data);
	}

	public function newsite($themes, $view = false, $data = null, callable $inject = null)
	{
		$this->ci->load->view('themes/' . $themes . '/master/header', $data);
		if (is_callable($inject)) {
			$inject();
		}
		$this->ci->load->view('themes/' . $themes . '/' . $view, $data);
		$this->ci->load->view('themes/' . $themes . '/master/footer', $data);
	}

	public function user($view, $data = null)
	{
		$this->ci->load->view('master/header', $data);
		$this->ci->load->view('master/sidebar', $data);
		$this->ci->load->view('master/breadcrumb', $data);
		$this->ci->load->view($view, $data);
		$this->ci->load->view('master/footer', $data);
	}

	public function pasien($view, $data = null)
	{
		$this->ci->load->view('pasien/master/header', $data);
		$this->ci->load->view('pasien/master/sidebar', $data);
		$this->ci->load->view($view, $data);
		$this->ci->load->view('pasien/master/footer', $data);
	}

	// public function pasiens($view, $data = null)
	// {
	// 	$this->ci->load->view('pasiens/master/header', $data);
	// 	$this->ci->load->view('pasiens/master/sidebar', $data);
	// 	$this->ci->load->view($view, $data);
	// 	$this->ci->load->view('pasiens/master/footer', $data);
	// }

	//simelue
	public function simpel_aja($view, $data = null)
	{
		$this->ci->load->view('simpel-aja/master/header', $data);
		$this->ci->load->view('simpel-aja/master/sidebar', $data);
		$this->ci->load->view($view, $data);
		$this->ci->load->view('simpel-aja/master/footer', $data);
	}
}
