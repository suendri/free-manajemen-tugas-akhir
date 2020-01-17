<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class pengajuanModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Nim
    public function getAllPengajuan($user_name) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE aju_user = :aju_user ORDER BY aju_id DESC";
        $query = $this->db->prepare($sql);
        $query->execute(array(':aju_user' => $user_name));

        return $query->fetchAll();
    }

    // Tampil Semua Nim
    public function getAllPengajuanInbox($user_name, $string, $katakunci, $startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user $string $katakunci ORDER BY aju_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $user_name));

        return $query->fetchAll();
    }

    // Tampil Jumlah pengajuan
    public function getAllPengajuanCount($user_name, $string, $katakunci) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user $string $katakunci";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $user_name));

        return $query->rowCount();
    }

    // Tampil Nim yang dicari
    public function getPengajuanLike($user_name, $katakunci) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user AND aju_judul LIKE '%$katakunci%'";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $user_name));

        return $query->fetchAll();
    }

    public function GetOptKategori() {
        $sql = "SELECT kat_id, kat_nama FROM gsta_kategori WHERE kat_aktif='Y' ORDER BY kat_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function GetOptProdi() {
        $sql = "SELECT pro_id, pro_nama FROM gsta_prodi WHERE pro_aktif='Y' ORDER BY pro_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function GetOptProdi2() {

        $sql = "SELECT t1.info_prodi_id AS ID,
                t1.info_datem,
                t1.info_dates,
                t1.info_aktif,
                t2.pro_id,
                t2.pro_nama AS NM,
                t2.pro_aktif
                FROM gsta_info t1
                LEFT JOIN gsta_prodi t2 ON t1.info_prodi_id=t2.pro_id
                WHERE t1.info_datem<=CURDATE() AND t1.info_dates>=CURDATE() 
                AND t1.info_aktif='Y' AND t2.pro_aktif='Y' ORDER BY t2.pro_nama";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    // Link edit
    public function getAjuForDetail($aju_id) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE aju_id = :aju_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':aju_id' => $aju_id));

        return $query->fetch();
    }

    // Proses Simpan
    public function getAjuForSave($data_insert) {
        $sql = "INSERT INTO gsta_pengajuan (
            aju_id,
            aju_user,
            aju_kat_id,
            aju_prodi_id,
            aju_judul,
            aju_abstrak,
            aju_filename)            
            VALUES (
            NULL,
            '$_SESSION[user_name]',
            :aju_kat_id,
            :aju_prodi_id,
            UPPER(:aju_judul),
            :aju_abstrak,
            :aju_filename)";

        $query = $this->db->prepare($sql);
        $query->execute($data_insert);

        $count = $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_SAVE_DATA_SUCCESS;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_SAVE_DATA_FAILED;
        }

        // default return
        return false;
    }

    // Proses Simpan
    public function getAjuForProses($data_update, $aju_id) {
        $sql = "UPDATE gsta_pengajuan SET
            aju_terima = :aju_terima,
            aju_komentar = :aju_komentar,
            aju_pemeriksa = :aju_pemeriksa,
            aju_tglperiksa = NOW()
            WHERE aju_id = '$aju_id' ";

        $query = $this->db->prepare($sql);
        $query->execute($data_update);

        $count = $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = "Proses Berhasil Dilakukan";
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_SAVE_DATA_FAILED;
        }

        // default return
        return false;
    }

}
