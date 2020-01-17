<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class pembimbingModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Nim
    public function getAllPembimbing($startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user AND aju_terima='Y' ORDER BY aju_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $_SESSION['user_name']));

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Pengajuan diterima pada Program Studi ybs
    public function getAllTerimaCount() {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user AND aju_terima='Y'";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $_SESSION['user_name']));

        return $query->rowCount();
    }
    
    // Tampil Nim yang dicari
    public function getAllTerimaLike($katakunci, $startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user AND aju_terima='Y' AND ( aju_user LIKE :katakunci OR user_nama_lengkap LIKE :katakunci ) ORDER BY aju_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $_SESSION['user_name'], ':katakunci' => '%'.$katakunci.'%'));

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Pengajuan diterima pada Program Studi ybs
    public function getAllTerimaLikeCount($katakunci) {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE pro_user = :pro_user AND aju_terima='Y' AND ( aju_user LIKE :katakunci OR user_nama_lengkap LIKE :katakunci )";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_user' => $_SESSION['user_name'], ':katakunci' => '%'.$katakunci.'%'));

        return $query->rowCount();
    }
    
    // Link edit
    public function getPembimbingForEdit($aju_id) {
        $sql = "SELECT * FROM gsta_pengajuan WHERE aju_id = :aju_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':aju_id' => $aju_id));

        return $query->fetch();
    }
    
    // Proses Simpan
    public function getPembimbingForUpdate($aju_id, $data_update) {
        $sql = "UPDATE gsta_pengajuan SET
            aju_pmmb1 = :aju_pmmb1,
            aju_pmmb2 = :aju_pmmb2 WHERE aju_id='$aju_id'";

        $query = $this->db->prepare($sql);
        $query->execute($data_update);

        $count = $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_UPDATE_DATA_SUCCESS;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_SAVE_DATA_FAILED;
        }

        // default return
        return false;
    }
}