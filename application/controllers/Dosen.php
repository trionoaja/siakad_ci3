<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model', 'dsn');
        $this->load->library('session');
        $this->load->library('FeederApi', [
            'url'      => 'http://192.168.10.50:3003/ws/live2.php',
            'username' => 'kampus@stmikglobal.ac.id',
            'password' => 'Global@123'
        ]);
    }

    public function index()
    {
        $data['items'] = $this->dsn->get_all();
        $this->load->view('feeder/header', ['title' => 'Dosen']);
        $this->load->view('feeder/dosen/index', $data);
        $this->load->view('feeder/footer');
    }

    public function sync()
{
    $token = $this->feederapi->get_token();
    if (!$token) {
        $this->session->set_flashdata('error', 'Gagal mendapatkan token dari Feeder');
        redirect('dosen');
    }

    $offset = 0;
    $limit  = 100;
    $total_sync = 0;
    $last_first_id = null; // untuk deteksi data berulang

    while (true) {
        $result = $this->feederapi->get_data('GetListDosen', '', '', $limit, $offset);

        if (empty($result['data'])) {
            break;
        }

        // Ambil ID pertama dari batch ini
        $current_first_id = isset($result['data'][0]['id_dosen']) ? $result['data'][0]['id_dosen'] : null;

        // Jika ID pertama sama dengan batch sebelumnya → kemungkinan data berulang → stop loop
        if ($current_first_id && $current_first_id === $last_first_id) {
            break;
        }

        $this->dsn->insert_or_update($result['data']);
        $total_sync += count($result['data']);

        // Simpan ID pertama untuk perbandingan batch berikutnya
        $last_first_id = $current_first_id;

        // Jika data yang diterima < limit, berarti batch terakhir
        if (count($result['data']) < $limit) {
            break;
        }

        $offset += $limit;
    }

    $this->session->set_flashdata('success', $total_sync . ' data dosen berhasil disinkronkan');
    redirect('dosen');
}
}
