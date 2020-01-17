<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class repositoryModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil Semua Nim
    public function getAllRepo($startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_view_repository ORDER BY repo_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Repository
    public function getAllRepoCount() {
        $sql = "SELECT * FROM gsta_view_repository";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->rowCount();
    }
    
    // Tampil Nim yang dicari
    public function getAllRepoLike($katakunci, $startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_view_repository WHERE repo_judul LIKE :katakunci ORDER BY repo_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute(array(':katakunci' => '%'.$katakunci.'%'));

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Repository
    public function getAllRepoLikeCount($katakunci) {
        $sql = "SELECT * FROM gsta_view_repository WHERE repo_judul LIKE :katakunci";
        $query = $this->db->prepare($sql);
        $query->execute(array(':katakunci' => '%'.$katakunci.'%'));

        return $query->rowCount();
    }
    
    // Link edit
    public function getRepoForEdit($repo_id) {
        $sql = "SELECT * FROM gsta_repository WHERE repo_id = :repo_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':repo_id' => $repo_id));

        return $query->fetch();
    }
    
    // Link edit
    public function getRepoForDetail($repo_id) {
        $sql = "SELECT * FROM gsta_view_repository WHERE repo_id = :repo_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':repo_id' => $repo_id));

        return $query->fetch();
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
    
    // Proses Simpan
    public function getRepoForSave($data_insert) {
        $sql = "INSERT INTO gsta_repository (
            repo_id,
            repo_cid,
            repo_nim,
            repo_nama,
            repo_kat_id,
            repo_prodi_id,
            repo_judul,
            repo_pmmb1,
            repo_pmmb2,
            repo_abstrak,
            repo_file,
            repo_login )            
            VALUES (
            '',
            :repo_cid,
            :repo_nim,
            :repo_nama,
            :repo_kat_id,
            :repo_prodi_id,
            :repo_judul,
            :repo_pmmb1,
            :repo_pmmb2,
            :repo_abstrak,
            :repo_file,
            '$_SESSION[user_name]')";

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
    public function getRepoForUpdate($repo_id, $data_update) {
        $sql = "UPDATE gsta_repository SET
            repo_cid = :repo_cid,
            repo_nim = :repo_nim,
            repo_nama = :repo_nama,
            repo_kat_id = :repo_kat_id,
            repo_prodi_id = :repo_prodi_id,
            repo_judul = :repo_judul,
            repo_pmmb1 = :repo_pmmb1,
            repo_pmmb2 = :repo_pmmb2,
            repo_abstrak = :repo_abstrak,
            repo_login = '$_SESSION[user_name]' WHERE repo_id='$repo_id'";

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
	
	public function getRepoForDelete($repo_id) {
        $sql = "DELETE FROM gsta_repository WHERE repo_id = :repo_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':repo_id' => $repo_id));

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
    
    public function getRepoForHit($repo_id) {
        $sql = "UPDATE gsta_repository SET repo_hit=repo_hit+1 WHERE repo_id = :repo_id";
        $query = $this->db->prepare($sql);
        return $query->execute(array(':repo_id' => $repo_id));
    }

    
}