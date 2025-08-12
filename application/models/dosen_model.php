<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db
            ->select('nidn,nuptk, nama_dosen, nama_program_studi')
            ->from('siakad_dosen')
            ->get()
            ->result();
    }

    public function insert_or_update($data)
    {
        if (empty($data) || !is_array($data)) {
            return;
        }

        foreach ($data as $row) {
            $id_dosen = isset($row['id_dosen']) ? $row['id_dosen'] : null;
            if (!$id_dosen) {
                continue;
            }

            // Mapping data ke tabel lokal
            $save = array(
                'id_dosen_ws'       => $id_dosen, // UUID dari Feeder
                'nidn'              => isset($row['nidn']) ? $row['nidn'] : null,
                'nuptk'              => isset($row['nuptk']) ? $row['nuptk'] : null,
                'nama_dosen'        => isset($row['nama_dosen']) ? $row['nama_dosen'] : null,
                'nama_program_studi'=> isset($row['nama_program_studi']) ? $row['nama_program_studi'] : null,
                'id_status_aktif_ws'=> isset($row['id_status_aktif']) ? $row['id_status_aktif'] : null,
                'tanggal_lahir'     => isset($row['tanggal_lahir']) ? $row['tanggal_lahir'] : null,
                'sumberdata'        => 'pddikti',
                'date_created'      => date('Y-m-d H:i:s')
            );

            // Cek apakah sudah ada di lokal
            $exists = $this->db->get_where('siakad_dosen', array('id_dosen_ws' => $id_dosen))->row();
            if ($exists) {
                unset($save['date_created']);
                $this->db->where('id_dosen_ws', $id_dosen)->update('siakad_dosen', $save);
            } else {
                $this->db->insert('siakad_dosen', $save);
            }
        }
    }
}
