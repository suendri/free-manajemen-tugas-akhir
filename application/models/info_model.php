<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class infoModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Info
    public function getAllInfo() {
        if ($_SESSION['user_account_type'] == 3 ){
            $string = "WHERE t2.pro_user='$_SESSION[user_name]'";
        } else {
            $string = NULL;
        }
        $sql = "SELECT t1.info_id AS ID,
            t1.info_prodi_id,
            t1.info_judul AS IJDL,
            t1.info_datem AS IDTM,
            t1.info_dates AS IDTS,
            t1.info_text AS ITXT,
            t1.info_aktif AS IAKT,
            t2.pro_id,
            t2.pro_nama AS INM,
            t2.pro_user
            FROM gsta_info t1
            LEFT JOIN gsta_prodi t2 ON t1.info_prodi_id=t2.pro_id $string";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    // Link edit
    public function getInfoForEdit($info_id) {
        $sql = "SELECT * FROM gsta_info WHERE info_id = :info_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':info_id' => $info_id));

        return $query->fetch();
    }

    public function getAllInfoNonAktif() {
        $sql = "UPDATE gsta_info SET info_aktif='N' 
                WHERE info_aktif='Y' 
                AND info_prodi_id=(SELECT pro_id FROM gsta_prodi WHERE pro_user='$_SESSION[user_name]') ";
        $query = $this->db->prepare($sql);
        $query->execute();
    }

    // Proses Simpan
    public function getInfoForSave($data_insert) {
        $sql = "INSERT INTO gsta_info VALUES ('',
            :info_prodi_id,
            :info_judul,
            :info_datem,
            :info_dates,
            :info_text,
            :info_aktif)";

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
    public function getInfoForUpdate($info_id, $data_update) {
        $sql = "UPDATE gsta_info SET
            info_prodi_id = :info_prodi_id,
            info_judul = :info_judul,
            info_datem = :info_datem,
            info_dates = :info_dates,
            info_text = :info_text,
            info_aktif = :info_aktif WHERE info_id='$info_id'";

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
    
    // Informasi aktif tidak bisa dihapus
    public function getInfoAktif($info_id) {
        $sql = "SELECT info_aktif FROM gsta_info WHERE info_id=:info_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':info_id' => $info_id));
        
        return $query->fetch();
    }

    public function getInfoForDelete($info_id) {
        $sql = "DELETE FROM gsta_info WHERE info_id = :info_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':info_id' => $info_id));

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

    public function GetOptProdi() {
        $sql = "SELECT pro_id, pro_nama FROM gsta_prodi WHERE pro_user='$_SESSION[user_name]' AND pro_aktif='Y' ORDER BY pro_id";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

}
