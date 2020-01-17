<?php

/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */

class dashboardModel {

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Link edit
    public function getProfilForEdit($user_id) {
        $sql = "SELECT * FROM gsta_users WHERE user_id = :user_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        return $query->fetch();
    }

    public function getProfilForUpdate($user_id, $data_update, $pass) {
        $sql = "UPDATE gsta_users SET
            $pass
            user_email = :user_email,
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

    // Lihat fungsi yang sama di login_model.php
    public function getUserAvatarFilePath() {
        $query = $this->db->prepare("SELECT photo_name FROM gsta_photo WHERE photo_user = :user_name ORDER BY photo_id DESC LIMIT 1");
        $query->execute(array(':user_name' => $_SESSION['user_name']));

        $_result = $query->fetch();
        if ($_result) {
            return URL . $_result->photo_name;
        } else {
            return URL . AVATAR_PATH . AVATAR_DEFAULT_IMAGE;
        }
    }

    public function getPhotoForInsert() {
        if (!is_dir(AVATAR_PATH) OR ! is_writable(AVATAR_PATH)) {
            $_SESSION["feedback_negative"][] = FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE;
            return false;
        }

        // Create directory if it does not exist
        if (!is_dir("public/avatars/" . $_SESSION['user_name'] . "/")) {
            mkdir("public/avatars/" . $_SESSION['user_name'] . "/");
        }

        if (!isset($_FILES['avatar_file']) OR empty($_FILES['avatar_file']['tmp_name'])) {
            $_SESSION["feedback_negative"][] = FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED;
            return false;
        }

        // Random Number untuk nama file
        $RandomNumber = rand(0, 9999999999);
        // get the image width, height and mime type
        $image_proportions = getimagesize($_FILES['avatar_file']['tmp_name']);

        // if input file too big (>5MB)
        if ($_FILES['avatar_file']['size'] > 5000000) {
            $_SESSION["feedback_negative"][] = FEEDBACK_AVATAR_UPLOAD_TOO_BIG;
            return false;
        }
        // if input file too small
        if ($image_proportions[0] < AVATAR_SIZE OR $image_proportions[1] < AVATAR_SIZE) {
            $_SESSION["feedback_negative"][] = FEEDBACK_AVATAR_UPLOAD_TOO_SMALL;
            return false;
        }

        if ($image_proportions['mime'] == 'image/jpeg' || $image_proportions['mime'] == 'image/png') {
            // create a jpg file in the avatar folder
            $target_file_path = AVATAR_PATH . $_SESSION['user_name'] . "/" . $RandomNumber . ".jpg";
            $this->resizeAvatarImage($_FILES['avatar_file']['tmp_name'], $target_file_path, 170, 200, AVATAR_JPEG_QUALITY, true);

            // Simpan Data Avatar
            $query = $this->db->prepare("INSERT INTO gsta_photo (photo_id, photo_user, photo_name) VALUES ('', :photo_user, :photo_name)");
            $query->execute(array(':photo_user' => $_SESSION['user_name'], ':photo_name' => $target_file_path));

            // Ganti Avatar user
            Session::set('user_avatar', $this->getUserAvatarFilePath());
            $_SESSION["feedback_positive"][] = FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL;
            return true;
        } else {
            $_SESSION["feedback_negative"][] = FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED;
            return false;
        }
    }

    // Resize Avatar
    public function resizeAvatarImage($source_image, $destination_filename, $width = 170, $height = 200, $quality = 100, $crop = true) {
        $image_data = getimagesize($source_image);
        if (!$image_data) {
            return false;
        }

        // set to-be-used function according to filetype
        switch ($image_data['mime']) {
            case 'image/gif':
                $get_func = 'imagecreatefromgif';
                $suffix = ".gif";
                break;
            case 'image/jpeg';
                $get_func = 'imagecreatefromjpeg';
                $suffix = ".jpg";
                break;
            case 'image/png':
                $get_func = 'imagecreatefrompng';
                $suffix = ".png";
                break;
        }

        $img_original = call_user_func($get_func, $source_image);
        $old_width = $image_data[0];
        $old_height = $image_data[1];
        $new_width = $width;
        $new_height = $height;
        $src_x = 0;
        $src_y = 0;
        $current_ratio = round($old_width / $old_height, 2);
        $desired_ratio_after = round($width / $height, 2);
        $desired_ratio_before = round($height / $width, 2);

        if ($old_width < $width OR $old_height < $height) {
            // the desired image size is bigger than the original image. Best not to do anything at all really.
            return false;
        }

        // if crop is on: it will take an image and best fit it so it will always come out the exact specified size.
        if ($crop) {
            // create empty image of the specified size
            $new_image = imagecreatetruecolor($width, $height);

            // landscape image
            if ($current_ratio > $desired_ratio_after) {
                $new_width = $old_width * $height / $old_height;
            }

            // nearly square ratio image
            if ($current_ratio > $desired_ratio_before AND $current_ratio < $desired_ratio_after) {

                if ($old_width > $old_height) {
                    $new_height = max($width, $height);
                    $new_width = $old_width * $new_height / $old_height;
                } else {
                    $new_height = $old_height * $width / $old_width;
                }
            }

            // portrait sized image
            if ($current_ratio < $desired_ratio_before) {
                $new_height = $old_height * $width / $old_width;
            }

            // find ratio of original image to find where to crop
            $width_ratio = $old_width / $new_width;
            $height_ratio = $old_height / $new_height;

            // calculate where to crop based on the center of the image
            $src_x = floor((($new_width - $width) / 2) * $width_ratio);
            $src_y = round((($new_height - $height) / 2) * $height_ratio);
        }
        // don't crop the image, just resize it proportionally
        else {
            if ($old_width > $old_height) {
                $ratio = max($old_width, $old_height) / max($width, $height);
            } else {
                $ratio = max($old_width, $old_height) / min($width, $height);
            }

            $new_width = $old_width / $ratio;
            $new_height = $old_height / $ratio;
            $new_image = imagecreatetruecolor($new_width, $new_height);
        }

        // create avatar thumbnail
        imagecopyresampled($new_image, $img_original, 0, 0, $src_x, $src_y, $new_width, $new_height, $old_width, $old_height);

        // save it as a .jpg file with our $destination_filename parameter
        imagejpeg($new_image, $destination_filename, $quality);

        // delete "working copy" and original file, keep the thumbnail
        imagedestroy($new_image);
        imagedestroy($img_original);

        if (file_exists($destination_filename)) {
            return true;
        }
        // default return
        return false;
    }

    public function getRepoTerakhir() {
        $sql = "SELECT * FROM gsta_view_repository ORDER BY repo_id DESC LIMIT 5";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getTotalPengajuanMasuk() {
        $sql = "SELECT * FROM gsta_view_pengajuan WHERE aju_terima IS NULL AND pro_user='$_SESSION[user_name]'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->rowCount();
    }

}
