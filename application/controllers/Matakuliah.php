<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Matakuliah_model', 'mk');
        $this->load->library('session');
        $this->load->library('FeederApi', [
            'url'      => 'http://192.168.10.50:3003/ws/live2.php',
            'username' => 'kampus@stmikglobal.ac.id',
            'password' => 'Global@123'
        ]);
    }

    public function index()
    {
        $data['items'] = $this->mk->get_all();
        $this->load->view('feeder/header', ['title' => 'Mata Kuliah']);
        $this->load->view('feeder/matakuliah/index', $data);
        $this->load->view('feeder/footer');
    }

    public function sync()
    {
        $token = $this->feederapi->get_token();
        if (!$token) {
            $this->session->set_flashdata('error', 'Gagal mendapatkan token dari Feeder');
            redirect('matakuliah');
        }

        $offset = 0;
        $limit  = 100;
        $total_sync = 0;

        while (true) {
            $result = $this->feederapi->get_data('GetListMataKuliah', '', '', $limit, $offset);

            if (empty($result['data'])) {
                break;
            }

            $this->mk->insert_or_update($result['data']);
            $total_sync += count($result['data']);
            $offset += $limit;
        }

        $this->session->set_flashdata('success', $total_sync . ' data mata kuliah berhasil disinkronkan');
        redirect('matakuliah');
    }
}
