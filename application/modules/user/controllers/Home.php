<?php

class Home extends UserController
{
	public function index()
	{
		$this->template->user('master/content');
	}
}