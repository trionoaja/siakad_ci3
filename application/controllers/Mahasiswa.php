<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');
        $this->load->library('session');
        $this->load->library('FeederApi', [
            'url'      => 'http://192.168.10.50:3003/ws/live2.php',
            'username' => 'kampus@stmikglobal.ac.id',
            'password' => 'Global@123'
        ]);
    }

    public function index()
    {
        $data['items'] = $this->mhs->get_all();
        $this->load->view('feeder/header', ['title' => 'Mahasiswa']);
        $this->load->view('feeder/mahasiswa/index', $data);
        $this->load->view('feeder/footer');
    }

    public function sync()
{
    $token = $this->feederapi->get_token();
    if (!$token) {
        $this->session->set_flashdata('error', 'Gagal mendapatkan token dari Feeder');
        redirect('mahasiswa');
    }

    $offset = 0;
    $limit  = 100;
    $total_sync = 0;
    $last_first_id = null; // untuk deteksi data berulang

    while (true) {
        $result = $this->feederapi->get_data('GetListMahasiswa', '', '', $limit, $offset);

        if (empty($result['data'])) {
            break; // tidak ada data, hentikan loop
        }

        // Ambil ID pertama dari batch ini
        $current_first_id = isset($result['data'][0]['id_mahasiswa']) ? $result['data'][0]['id_mahasiswa'] : null;

        // Jika sama dengan batch sebelumnya → hentikan loop (duplikat terdeteksi)
        if ($current_first_id && $current_first_id === $last_first_id) {
            break;
        }

        $this->mhs->insert_or_update($result['data']);
        $total_sync += count($result['data']);

        // Simpan untuk pengecekan di batch berikutnya
        $last_first_id = $current_first_id;

        // Jika jumlah data < limit → berarti batch terakhir
        if (count($result['data']) < $limit) {
            break;
        }

        $offset += $limit;
    }

    $this->session->set_flashdata('success', $total_sync . ' data mahasiswa berhasil disinkronkan');
    redirect('mahasiswa');
}

}
