<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class userModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Tampil
    public function getAllUser($startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_users ORDER BY user_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Repository
    public function getAllUserCount() {
        $sql = "SELECT * FROM gsta_users";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->rowCount();
    }
    
    // Tampil Nim yang dicari
    public function getAllUserLike($katakunci, $startlimit, $pagelimit) {
        $sql = "SELECT * FROM gsta_users WHERE user_nama_lengkap LIKE :katakunci ORDER BY user_id DESC LIMIT $startlimit, $pagelimit";
        $query = $this->db->prepare($sql);
        $query->execute(array(':katakunci' => '%'.$katakunci.'%'));

        return $query->fetchAll();
    }
    
    // Tampil Jumlah Repository
    public function getAllUserLikeCount($katakunci) {
        $sql = "SELECT * FROM gsta_users WHERE user_nama_lengkap LIKE :katakunci";
        $query = $this->db->prepare($sql);
        $query->execute(array(':katakunci' => '%'.$katakunci.'%'));

        return $query->rowCount();
    }
    

    // Link edit
    public function getUserForEdit($user_id) {
        $sql = "SELECT * FROM gsta_users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        return $query->fetch();
    }

    // Proses Simpan
    public function getUserForSave($data_insert) {
        $sql = "INSERT INTO gsta_users VALUES ('',
            :user_name,
            :user_password_hash,
            :user_email,
            :user_account_type,
            :user_active,
            :user_nama_lengkap)";

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
    public function getUserForUpdate($user_id, $data_update, $pass) {
        $sql = "UPDATE gsta_users SET
            $pass
            user_email = :user_email,
            user_account_type = :user_account_type,
            user_active = :user_active,
            user_nama_lengkap = :user_nama_lengkap WHERE user_id='$user_id'";

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

    public function getUserForDelete($user_id) {
        $sql = "DELETE FROM gsta_users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

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
