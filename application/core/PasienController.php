<?php

class PasienController extends BaseController
{
    public function __construct()
	{
        parent::__construct();
        $token = $_COOKIE['token'];
        if(empty($token)) {
            redirect('pendaftaran/login');
        }
    }  
    
}
