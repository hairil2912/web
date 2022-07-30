<?php defined('BASEPATH') OR exit ('No direct script access allowed');

class Lokasi extends PasienController
{
    public function index(){
       
        $data['user'] = json_decode($_COOKIE['user']);
        $this->template->pasien('lokasi/index', $data);
    }
}