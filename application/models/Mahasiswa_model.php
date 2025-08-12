<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_or_update($data)
{
    foreach ($data as $row) {
        $exists = $this->db->get_where('siakad_mahasiswa', ['id_mahasiswa' => $row['id_mahasiswa']])->row();

        if ($exists) {
            $this->db->where('id_mahasiswa', $row['id_mahasiswa'])->update('siakad_mahasiswa', $row);
        } else {
            $this->db->insert('siakad_mahasiswa', $row);
        }
    }
}
   public function get_all()
{
    return $this->db
        ->select('nim, nama_mahasiswa, nama_program_studi')
        ->from('siakad_mahasiswa')
        ->get()
        ->result();
}
}
