<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {
    protected $table = 'siakad_kelas';
    public function get_all($limit = 200) {
        return $this->db->get($this->table, $limit)->result_array();
    }

    public function insert_or_update($data) {
        // Basic mapping: try to find by NIM / kode unique fields; adapt as needed
        if (isset($data['nim'])) {
            $row = $this->db->get_where($this->table, ['nim' => $data['nim']])->row();
            if ($row) {
                $this->db->where('nim', $data['nim'])->update($this->table, $data);
                return;
            }
        }
        $this->db->insert($this->table, $data);
    }
}
