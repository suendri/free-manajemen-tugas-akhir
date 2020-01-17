<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class laporanModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampilkan semua Pengajuan diterima
    public function getAllTerima($data_cari) {
        $sql = "SELECT aju_user, 
                user_nama_lengkap,
                aju_judul,
                kat_nama,
                aju_pmmb1,
                aju_pmmb2
                FROM gsta_view_pengajuan
                WHERE aju_creation_date >= :tgl_awal AND aju_creation_date <= :tgl_akhir AND pro_id=(SELECT pro_id FROM gsta_prodi WHERE pro_user='$_SESSION[user_name]')";
        $query = $this->db->prepare($sql);
        $query->execute($data_cari);

        return $query->fetchAll();
    }

}
