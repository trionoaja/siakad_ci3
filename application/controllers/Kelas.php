<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('kelas_model');
    }

    public function index() {
        $data['items'] = $this->kelas_model->get_all();
        $this->load->view('feeder/header', ['title' => 'Kelas']);
        $this->load->view('feeder/kelas/index', $data);
        $this->load->view('feeder/footer');
    }

    public function sync() {
        // call feeder API
        $res = $this->feederapi->request('GetListKelasKuliah');
        if (isset($res['error'])) {
            $this->log('Kelas', 'Get', 'failed', json_encode($res));
            $this->session->set_flashdata('msg', 'Error: ' . json_encode($res));
        } else {
            // attempt to save results (assume data at ['data'])
            $count = 0;
            if (isset($res['data'])) {
                foreach ($res['data'] as $row) {
                    $this->kelas_model->insert_or_update($row);
                    $count++;
                }
            }
            $this->log('Kelas', 'Get', 'success', 'Imported ' . $count . ' records');
            $this->session->set_flashdata('msg', 'Imported ' . $count . ' records');
        }
        redirect(site_url('kelas'));
    }
    public function push() {
        $items = $this->kelas_model->get_all();
        $count_success = 0;
        $count_failed = 0;
        foreach ($items as $row) {
            $res = $this->feederapi->request('InsertKelasKuliah', $row);
            if (isset($res['error']) || (isset($res['result']) && $res['result'] == 'gagal')) {
                $count_failed++;
                $this->log('Kelas', 'Insert', 'failed', json_encode($res));
            } else {
                $count_success++;
                $this->log('Kelas', 'Insert', 'success', json_encode($res));
            }
        }
        $this->session->set_flashdata('msg', "Push selesai: Berhasil=$count_success, Gagal=$count_failed");
        redirect(site_url('kelas'));
    }

}
