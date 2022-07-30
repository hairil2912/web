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
        $no_tiket_full = $this->input->get('no_tiket_full');

        $barcodeOptions = [
            'text' => $no_tiket_full,
            'barHeight' => 20,
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
