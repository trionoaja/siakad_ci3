<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
    protected $table = 'log_sinkronisasi';
    public function insert($modul, $jenis_aksi, $status, $keterangan='') {
        $data = [
            'modul' => $modul,
            'jenis_aksi' => $jenis_aksi,
            'status' => $status,
            'keterangan' => $keterangan
        ];
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all($limit = 100) {
        return $this->db->order_by('waktu', 'DESC')->get($this->table, $limit)->result_array();
    }
}
