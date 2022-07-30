<?php

class Barcode extends PasienController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
    }
    public function index()
    {
        $no_register = $this->input->get('no_register');

        $barcodeOptions = [
            'text' => $no_register,
            'barHeight' => 74,
            'factor' => 3.98,
            'drawText' => false,
        ];

        $rendererOptions = [];

        Zend_Barcode::factory(
            'code128',
            'image',
            $barcodeOptions,
            $rendererOptions
        )->render();
    }
}
