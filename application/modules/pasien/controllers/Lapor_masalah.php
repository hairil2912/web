<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lapor_masalah extends PasienController
{
    public function index()
    {
        $this->template->pasien('lapor-masalah/index');
    }
}