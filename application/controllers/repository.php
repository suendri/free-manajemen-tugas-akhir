<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Repository extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }

    function index() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $_SESSION['repocari'] = NULL;
        // Load Model
        $repo_model = $this->loadModel('repository');
        $this->view->repos = $repo_model->getAllRepo(0, $pagelimit);
        $this->view->total = $repo_model->getAllRepoCount();
        $this->view->renderDashboard('repository/index');
    }

    function page($startlimit) {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = $startlimit;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $position = ($startlimit - 1) * $pagelimit;
        
        // Load Model
        $repo_model = $this->loadModel('repository');
        // Jika ada $_SESSION['repocari']
        if (isset($_SESSION['repocari'])) {
            $this->view->repos = $repo_model->getAllRepoLike($_SESSION['repocari'], $position, $pagelimit);
            $this->view->total = $repo_model->getAllRepoLikeCount($_SESSION['repocari']); 
        } else {
            $this->view->repos = $repo_model->getAllRepo($position, $pagelimit);
            $this->view->total = $repo_model->getAllRepoCount(); 
        }
        
        $this->view->renderDashboard('repository/index');
    }

    function repoCari() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        // POST katakunci
        $katakunci = htmlspecialchars($_POST['katakunci']);
        // Load Model
        $repo_model = $this->loadModel('repository');

        if ($katakunci == "") {
            header('location: ' . URL . 'repository/index');
        } else {
            $_SESSION['repocari'] = $katakunci;
            $this->view->repos = $repo_model->getAllRepoLike($katakunci, 0, $pagelimit);
            $this->view->total = $repo_model->getAllRepoLikeCount($katakunci);
            $this->view->renderDashboard('repository/cari');
        }
    }

    public function repoAdd() {
        if ($_SESSION['user_account_type'] <= 2) {
            $repo_model = $this->loadModel('repository');
            $this->view->optKategori = $repo_model->GetOptKategori();
            $this->view->optProdi = $repo_model->GetOptProdi();
            $this->view->renderDashboard('repository/add');
        } else {
            header('location: ' . URL . 'repository');
        }
    }

    public function repoEdit($repo_id) {
        if ($_SESSION['user_account_type'] <= 2) {
            if (isset($repo_id)) {
                $repo_model = $this->loadModel('repository');
                $this->view->optKategori = $repo_model->GetOptKategori();
                $this->view->optProdi = $repo_model->GetOptProdi();
                $this->view->repo = $repo_model->getRepoForEdit($repo_id);
                $this->view->renderDashboard('repository/edit');
            } else {
                header('location: ' . URL . 'repository');
            }
        } else {
            header('location: ' . URL . 'repository');
        }
    }

    public function detail($repo_id) {
        if (isset($repo_id)) {
            $repo_model = $this->loadModel('repository');
            // Hit View
            $repo_model->getRepoForHit($repo_id);

            $this->view->optKategori = $repo_model->GetOptKategori();
            $this->view->optProdi = $repo_model->GetOptProdi();
            $this->view->repo = $repo_model->getRepoForDetail($repo_id);
            $this->view->renderDashboard('repository/detail');
        } else {
            header('location: ' . URL . 'repository');
        }
    }

    public function saveAdd() {

        //$_SESSION["feedback_negative"] = NULL;
        $file_name = $_FILES['repo_file']['name'];
        $file_size = $_FILES['repo_file']['size'];
        $file_tmp = $_FILES['repo_file']['tmp_name'];
        $file_type = $_FILES['repo_file']['type'];

        if (isset($_FILES['repo_file']) && $file_size > 0) {

            // Random Number untuk nama file
            $randomNumber = rand(0, 9999999999);
            $targetName = $randomNumber . "_" . $file_name;

            if ($file_size > 5000000) {
                $_SESSION["feedback_negative"][] = "Ukuran File Terlalu Besar, File Tidak Disimpan!";
                $targetName = NULL;
            }
            if ($file_type != 'application/pdf') {
                $_SESSION["feedback_negative"][] = "Tipe File Tidak Diizinkan, File Tidak Disimpan!";
                $targetName = NULL;
            }
            if (empty($_SESSION["feedback_negative"]) == TRUE) {
                move_uploaded_file($file_tmp, FILES_PATH . $targetName);
            }
        } else {
            $targetName = NULL;
        }
        // 1. Ambil Post
        $_repo_cid = htmlspecialchars($_POST['repo_cid']);
        $_repo_nim = htmlspecialchars($_POST['repo_nim']);
        $_repo_nama = htmlspecialchars($_POST['repo_nama']);
        $_repo_kat = htmlspecialchars($_POST['repo_kat_id']);
        $_repo_prodi = htmlspecialchars($_POST['repo_prodi_id']);
        $_repo_judul = htmlspecialchars($_POST['repo_judul']);
        $_repo_pb1 = htmlspecialchars($_POST['repo_pb1']);
        $_repo_pb2 = htmlspecialchars($_POST['repo_pb2']);
        $_repo_abstrak = htmlspecialchars($_POST['repo_abstrak']);


        // 2. Arraykan
        $data_insert = array(
            ':repo_cid' => $_repo_cid,
            ':repo_nim' => $_repo_nim,
            ':repo_nama' => $_repo_nama,
            ':repo_kat_id' => $_repo_kat,
            ':repo_prodi_id' => $_repo_prodi,
            ':repo_judul' => $_repo_judul,
            ':repo_pmmb1' => $_repo_pb1,
            ':repo_pmmb2' => $_repo_pb2,
            ':repo_abstrak' => $_repo_abstrak,
            ':repo_file' => $targetName
        );

        // 3. Proses ke Model
        if (!empty($_repo_nama)) {
            $repo_model = $this->loadModel('repository');
            $repo_model->getRepoForSave($data_insert);
        }
        header('location: ' . URL . 'repository');
    }

    public function saveEdit($repo_id) {

        // 1. Ambil Post
        $_repo_cid = htmlspecialchars($_POST['repo_cid']);
        $_repo_nim = htmlspecialchars($_POST['repo_nim']);
        $_repo_nama = htmlspecialchars($_POST['repo_nama']);
        $_repo_kat = htmlspecialchars($_POST['repo_kat_id']);
        $_repo_prodi = htmlspecialchars($_POST['repo_prodi_id']);
        $_repo_judul = htmlspecialchars($_POST['repo_judul']);
        $_repo_pb1 = htmlspecialchars($_POST['repo_pb1']);
        $_repo_pb2 = htmlspecialchars($_POST['repo_pb2']);
        $_repo_abstrak = htmlspecialchars($_POST['repo_abstrak']);


        // 2. Arraykan
        $data_update = array(
            ':repo_cid' => $_repo_cid,
            ':repo_nim' => $_repo_nim,
            ':repo_nama' => $_repo_nama,
            ':repo_kat_id' => $_repo_kat,
            ':repo_prodi_id' => $_repo_prodi,
            ':repo_judul' => $_repo_judul,
            ':repo_pmmb1' => $_repo_pb1,
            ':repo_pmmb2' => $_repo_pb2,
            ':repo_abstrak' => $_repo_abstrak
        );

        // 3. Proses ke Model
        if (!empty($repo_id) && !empty($_repo_nama)) {
            $repo_model = $this->loadModel('repository');
            $repo_model->getRepoForUpdate($repo_id, $data_update);
        }
        header('location: ' . URL . 'repository');
    }

    public function delete($repo_id) {
        if ($_SESSION['user_account_type'] <= 2) {
            if (isset($repo_id)) {
                $repo_model = $this->loadModel('repository');
                $repo_model->getRepoForDelete($repo_id);
            }
            header('location: ' . URL . 'repository');
        } else {
            header('location: ' . URL . 'repository');
        }
    }

}
