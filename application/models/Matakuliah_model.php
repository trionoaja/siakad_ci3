<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah_model extends CI_Model {

    private $table = 'siakad_matakuliah';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function insert_or_update($data)
    {
        foreach ($data as $row) {
            $exists = $this->db->get_where($this->table, [
                'id_matkul' => $row['id_matkul']
            ])->row();

            if ($exists) {
                $this->db->where('id_matkul', $row['id_matkul']);
                $this->db->update($this->table, $row);
            } else {
                $this->db->insert($this->table, $row);
            }
        }
    }
}
