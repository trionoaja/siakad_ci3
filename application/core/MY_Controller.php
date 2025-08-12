<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('FeederApi');
        $this->load->model('Log_model');
    }

    protected function log($modul, $aksi, $status, $keterangan='') {
        $this->Log_model->insert($modul, $aksi, $status, $keterangan);
    }
}
