<?php
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class LoginModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function loginCount($user) {
        $sth = $this->db->prepare("SELECT * FROM gsta_users
                                   WHERE user_name = :user_name AND user_active = 'Y'");

        $sth->execute(array(':user_name' => $user));
        return $sth->rowCount();
    }
    
    public function loginRow($user) {
        $sth = $this->db->prepare("SELECT * FROM gsta_users
                                   WHERE user_name = :user_name AND user_active = 'Y'");

        $sth->execute(array(':user_name' => $user));
        return $sth->fetch();
    }
    
    // Proses Simpan
    public function getRegForSave($data_insert, $_username) {
        $sql = "INSERT INTO gsta_users (
            user_name,
            user_password_hash,
            user_email,
            user_nama_lengkap)
            VALUES (
            :user_name,
            :user_password_hash,
            :user_email,
            :user_nama_lengkap)";

        $query = $this->db->prepare($sql);
        $query->execute($data_insert);
        
        // Perbaharui NIM menjadi aktif karena sudah digunakan
        $query2 = $this->db->prepare("UPDATE gsta_nim SET nim_aktif='Y' WHERE nim_no= :nim_no");
        $query2->execute(array(':nim_no' => $_username));


        $count = $query->rowCount();
        if ($count == 1) {
            $_SESSION["feedback_positive"][] = FEEDBACK_REG_DATA_SUCCESS;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_REG_DATA_FAILED;
        }

        // default return
        return false;
    }
    
    public function getNimData($user_nim) {
        $sql = "SELECT nim_no FROM gsta_nim WHERE nim_no='$user_nim' AND nim_aktif='N'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }
    
    // Lihat fungsi yang sama di dashboard_model.php
    public function getUserAvatarFilePath()
    {
        $query = $this->db->prepare("SELECT photo_name FROM gsta_photo WHERE photo_user = :user_name ORDER BY photo_id DESC LIMIT 1");
        $query->execute(array(':user_name' => $_SESSION['user_name']));

        $_result = $query->fetch();
        if ($_result) {
            return URL . $_result->photo_name;
        } else {
            return URL . AVATAR_PATH . AVATAR_DEFAULT_IMAGE;
        }
    }  
}
