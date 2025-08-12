<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akm extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('akm_model');
    }

    public function index() {
        $data['items'] = $this->akm_model->get_all();
        $this->load->view('feeder/header', ['title' => 'Akm']);
        $this->load->view('feeder/akm/index', $data);
        $this->load->view('feeder/footer');
    }

    public function sync() {
        // call feeder API
        $res = $this->feederapi->request('GetAktivitasKuliahMahasiswa');
        if (isset($res['error'])) {
            $this->log('Akm', 'Get', 'failed', json_encode($res));
            $this->session->set_flashdata('msg', 'Error: ' . json_encode($res));
        } else {
            // attempt to save results (assume data at ['data'])
            $count = 0;
            if (isset($res['data'])) {
                foreach ($res['data'] as $row) {
                    $this->akm_model->insert_or_update($row);
                    $count++;
                }
            }
            $this->log('Akm', 'Get', 'success', 'Imported ' . $count . ' records');
            $this->session->set_flashdata('msg', 'Imported ' . $count . ' records');
        }
        redirect(site_url('akm'));
    }
    public function push() {
        $items = $this->akm_model->get_all();
        $count_success = 0;
        $count_failed = 0;
        foreach ($items as $row) {
            $res = $this->feederapi->request('InsertAktivitasKuliahMahasiswa', $row);
            if (isset($res['error']) || (isset($res['result']) && $res['result'] == 'gagal')) {
                $count_failed++;
                $this->log('Akm', 'Insert', 'failed', json_encode($res));
            } else {
                $count_success++;
                $this->log('Akm', 'Insert', 'success', json_encode($res));
            }
        }
        $this->session->set_flashdata('msg', "Push selesai: Berhasil=$count_success, Gagal=$count_failed");
        redirect(site_url('akm'));
    }

}
