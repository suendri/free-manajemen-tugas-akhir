<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class kategoriModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Nim
    public function getAllKategori() {
        $sql = "SELECT * FROM gsta_kategori";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    } 
    
    // Link edit
    public function getKategoriForEdit($kat_id) {
        $sql = "SELECT * FROM gsta_kategori WHERE kat_id = :kat_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':kat_id' => $kat_id));

        return $query->fetch();
    }
    
    // Proses Simpan
    public function getKategoriForSave($data_insert) {
        $sql = "INSERT INTO gsta_kategori VALUES ('',
            :kat_nama,
            :kat_aktif)";

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
    public function getKategoriForUpdate($kat_id, $data_update) {
        $sql = "UPDATE gsta_kategori SET
            kat_nama = :kat_nama,
            kat_aktif = :kat_aktif WHERE kat_id='$kat_id'";

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
    
    public function getKategoriForDelete($kat_id) {
        $sql = "DELETE FROM gsta_kategori WHERE kat_id = :kat_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':kat_id' => $kat_id));

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