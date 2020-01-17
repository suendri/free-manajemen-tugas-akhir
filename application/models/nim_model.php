<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class nimModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }
    
    public function getAllNim($startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_nim ORDER BY nim_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    // Tampil Jumlah Nim
    public function getAllNimCount() {
        $sql = "SELECT * FROM gsta_nim";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->rowCount();
    }
    
    // Tampil Nim yang dicari
    public function getAllNimLike($katakunci) {
        $sql = "SELECT * FROM gsta_nim WHERE nim_no LIKE '%$katakunci%'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    // Proses Simpan
    public function getNimForSave($data_insert) {
        $sql = "INSERT INTO gsta_nim (
            nim_id,
            nim_no,
            nim_creator )
            VALUES ('',
            :nim_no,
            :nim_creator)";

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
    
    public function getNimForDelete($nim_id) {
        $sql = "DELETE FROM gsta_nim WHERE nim_id = :nim_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':nim_id' => $nim_id));

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