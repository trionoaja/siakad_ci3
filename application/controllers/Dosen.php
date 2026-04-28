<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model', 'dsn');
        $this->load->library('session');
    }

    public function index()
    {
        $data['items'] = $this->dsn->get_all();
        $this->load->view('feeder/header', array('title' => 'Dosen'));
        $this->load->view('feeder/dosen/index', $data);
        $this->load->view('feeder/footer');
    }
    public function create()
{
    $this->load->view('feeder/header');
    $this->load->view('feeder/dosen/create');
    $this->load->view('feeder/footer');
}

public function store()
{
    $data = [
        'nama_dosen'       => $this->input->post('nama_dosen'),
        'nidn'             => $this->input->post('nidn'),
        'nuptk'             => $this->input->post('nuptk'),
        'jenis_kelamin'    => $this->input->post('jenis_kelamin'),
        'tempat_lahir'     => $this->input->post('tempat_lahir'),
        'tanggal_lahir'    => $this->input->post('tanggal_lahir'),
        'id_agama'         => $this->input->post('id_agama'),
        'nama_ibu_kandung' => $this->input->post('nama_ibu_kandung')
    ];

    $this->dsn->insert($data);
    $this->session->set_flashdata('success', 'Dosen berhasil ditambahkan.');
    redirect('dosen');
}

    public function push($id_dosen)
    {
        // Ambil token lokal
        $token_lokal  = $this->getTokenFeeder(
            'http://localhost:3003/ws/live2.php',
            'user_feeder_lokal',
            'pass_lokal'
        );

        // Ambil token server
        $token_server = $this->getTokenFeeder(
            'http://103.xxx.xxx.xxx:3003/ws/live2.php',
            'user_feeder_server',
            'pass_server'
        );

        if (!$token_lokal || !$token_server) {
            $this->session->set_flashdata('error', 'Gagal mendapatkan token dari Feeder.');
            redirect('dosen');
        }

        $dosen = $this->dsn->get_by_id($id_dosen);
        if (!$dosen) {
            $this->session->set_flashdata('error', 'Data dosen tidak ditemukan.');
            redirect('dosen');
        }

        $record = array(
            'nama_dosen'       => $dosen->nama_dosen,
            'nidn'             => $dosen->nidn,
            'jenis_kelamin'    => $dosen->jenis_kelamin,
            'tempat_lahir'     => $dosen->tempat_lahir,
            'tanggal_lahir'    => $dosen->tanggal_lahir,
            'id_agama'         => $dosen->id_agama,
            'nama_ibu_kandung' => $dosen->nama_ibu_kandung
        );

        $res1 = $this->insertFeeder('http://localhost:3003/ws/live2.php', 'dosen', $record, $token_lokal);
        $res2 = $this->insertFeeder('http://103.xxx.xxx.xxx:3003/ws/live2.php', 'dosen', $record, $token_server);

        if (isset($res1['error_code']) && $res1['error_code'] == 0 &&
            isset($res2['error_code']) && $res2['error_code'] == 0) {
            $this->session->set_flashdata('success', 'Push berhasil ke Feeder lokal & server.');
        } else {
            $err1 = isset($res1['error_desc']) ? $res1['error_desc'] : 'Tidak ada respon lokal';
            $err2 = isset($res2['error_desc']) ? $res2['error_desc'] : 'Tidak ada respon server';
            $this->session->set_flashdata('error', 'Push gagal: ' . $err1 . ' | ' . $err2);
        }

        redirect('dosen');
    }

    private function getTokenFeeder($url, $username, $password)
    {
        $data = array(
            'act'      => 'GetToken',
            'username' => $username,
            'password' => $password
        );

        $result = $this->curlPost($url, $data);
        if (isset($result['data']['token'])) {
            return $result['data']['token'];
        } else {
            return null;
        }
    }

    private function insertFeeder($url, $table, $record, $token)
    {
        $data = array(
            'act'    => 'InsertRecord',
            'token'  => $token,
            'table'  => $table,
            'record' => $record
        );
        return $this->curlPost($url, $data);
    }

    private function curlPost($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
