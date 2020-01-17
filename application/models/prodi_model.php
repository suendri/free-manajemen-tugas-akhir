<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class prodiModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Nim
    public function getAllProdi() {
        $sql = "SELECT t1.pro_id AS ID, 
                t1.pro_nama AS NM, 
                t1.pro_user, 
                t1.pro_aktif AS AKT,
                t2.user_name,
                t2.user_nama_lengkap AS KPS
                FROM gsta_prodi t1
                INNER JOIN gsta_users t2 ON t1.pro_user=t2.user_name";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }  
    
    public function GetOptKps() {
        $sql = "SELECT user_name, user_nama_lengkap FROM gsta_users WHERE user_account_type='3' ";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    // Link edit
    public function getProdiForEdit($pro_id) {
        $sql = "SELECT * FROM gsta_prodi WHERE pro_id = :pro_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_id' => $pro_id));

        return $query->fetch();
    }

    // Proses Simpan
    public function getProdiForSave($data_insert) {
        $sql = "INSERT INTO gsta_prodi VALUES ('',
            :pro_nama,
            :pro_user,
            :pro_aktif)";

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
    public function getProdiForUpdate($pro_id, $data_update) {
        $sql = "UPDATE gsta_prodi SET
            pro_nama = :pro_nama,
            pro_user = :pro_user,
            pro_aktif = :pro_aktif WHERE pro_id='$pro_id'";

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
    
    public function getProdiForDelete($pro_id) {
        $sql = "DELETE FROM gsta_prodi WHERE pro_id = :pro_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':pro_id' => $pro_id));

        $count = $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_DELETE_DATA_SUCCESS;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_DELETE_DATA_FAILED;
        }
        // default return
        return false;
    }
}