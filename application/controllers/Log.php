<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['logs'] = $this->Log_model->get_all(500);
        $this->load->view('feeder/header', ['title' => 'Log Sinkronisasi']);
        $this->load->view('feeder/log/index', $data);
        $this->load->view('feeder/footer');
    }
}
