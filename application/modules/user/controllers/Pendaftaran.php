<?php

class Pendaftaran extends UserController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template->user('pendaftaran/pendaftaran');
	}
}