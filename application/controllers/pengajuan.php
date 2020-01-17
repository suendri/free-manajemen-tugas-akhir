<?php

/*
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

class Pengajuan extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }

    function index() {
        if ($_SESSION['user_account_type'] <= 3) {
            header('location: ' . URL . 'pengajuan/inbox');
        } else {
            $aju_model = $this->loadModel('pengajuan');
            $this->view->ajus = $aju_model->getAllPengajuan($_SESSION['user_name']);
            $this->view->renderDashboard('pengajuan/index');
        }
    }

    function info() {
        $info_model = $this->loadModel('info');
        $this->view->infos = $info_model->getAllInfo();
        $this->view->renderDashboard('pengajuan/info');
    }

    function inbox() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;

        $user_name = $_SESSION['user_name'];
        $_SESSION['ajucari'] = NULL;
        $_SESSION['pagesesi'] = "AND aju_terima IS NULL";

        if ($_SESSION['user_account_type'] > 3) {
            header('location: ' . URL . 'pengajuan/index');
        } else {
            $aju_model = $this->loadModel('pengajuan');
            $this->view->title = "Belum Diproses";
            $this->view->ajus = $aju_model->getAllPengajuanInbox($user_name, 'AND aju_terima IS NULL', NULL, 0, $pagelimit);
            $this->view->total = $aju_model->getAllPengajuanCount($user_name, 'AND aju_terima IS NULL', NULL);
            $this->view->renderDashboard('pengajuan/inbox');
        }
    }

    function terima() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;

        $user_name = $_SESSION['user_name'];
        $_SESSION['ajucari'] = NULL;
        $_SESSION['pagesesi'] = "AND aju_terima='Y'";

        if ($_SESSION['user_account_type'] > 3) {
            header('location: ' . URL . 'pengajuan/index');
        } else {
            $aju_model = $this->loadModel('pengajuan');
            $this->view->title = "Diterima";
            $this->view->ajus = $aju_model->getAllPengajuanInbox($user_name, "AND aju_terima='Y'", NULL, 0, $pagelimit);
            $this->view->total = $aju_model->getAllPengajuanCount($user_name, "AND aju_terima='Y'", NULL);
            $this->view->renderDashboard('pengajuan/inbox');
        }
    }

    function tolak() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;

        $user_name = $_SESSION['user_name'];
        $_SESSION['ajucari'] = NULL;
        $_SESSION['pagesesi'] = "AND aju_terima='N'";

        if ($_SESSION['user_account_type'] > 3) {
            header('location: ' . URL . 'pengajuan/index');
        } else {
            $aju_model = $this->loadModel('pengajuan');
            $this->view->title = "Ditolak";
            $this->view->ajus = $aju_model->getAllPengajuanInbox($user_name, "AND aju_terima='N'", NULL, 0, $pagelimit);
            $this->view->total = $aju_model->getAllPengajuanCount($user_name, "AND aju_terima='N'", NULL);
            $this->view->renderDashboard('pengajuan/inbox');
        }
    }

    function semua() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;

        $user_name = $_SESSION['user_name'];
        $_SESSION['ajucari'] = NULL;
        $_SESSION['pagesesi'] = NULL;

        if ($_SESSION['user_account_type'] > 3) {
            header('location: ' . URL . 'pengajuan/index');
        } else {
            $aju_model = $this->loadModel('pengajuan');
            $this->view->title = "Semua Judul";
            $this->view->ajus = $aju_model->getAllPengajuanInbox($user_name, NULL, NULL, 0, $pagelimit);
            $this->view->total = $aju_model->getAllPengajuanCount($user_name, NULL, NULL);
            $this->view->renderDashboard('pengajuan/inbox');
        }
    }

    function page($startlimit) {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = $startlimit;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $position = ($startlimit - 1) * $pagelimit;

        $user_name = $_SESSION['user_name'];
        $katakunci = isset($_SESSION['ajucari']) ? "AND aju_judul LIKE '%$_SESSION[ajucari]%'" : NULL;
        // Load Model
        $aju_model = $this->loadModel('pengajuan');
        $this->view->title = "";
        $this->view->ajus = $aju_model->getAllPengajuanInbox($user_name, $_SESSION['pagesesi'], $katakunci, $position, $pagelimit);
        $this->view->total = $aju_model->getAllPengajuanCount($user_name, $_SESSION['pagesesi'], $katakunci);
        $this->view->renderDashboard('pengajuan/inbox');
    }

    function ajuCari() {
        $pagelimit = 10;
        $pagerange = 5;
        $this->view->page = 1;
        $this->view->position = $pagelimit;
        $this->view->range = $pagerange;
        $user_name = $_SESSION['user_name'];
        // POST katakunci
        $katakunci = htmlspecialchars($_POST['katakunci']);
        // Load Model
        $aju_model = $this->loadModel('pengajuan');

        if ($katakunci == "") {
            header('location: ' . URL . 'pengajuan/inbox');
        } else {
            $_SESSION['ajucari'] = $katakunci;
            $this->view->title = "Pencarian Judul";
            $this->view->ajus = $aju_model->getPengajuanLike($user_name, $katakunci);
            $this->view->total = $aju_model->getAllPengajuanCount($user_name, NULL, "AND aju_judul LIKE '%$katakunci%'");
            $this->view->renderDashboard('pengajuan/cari');
        }
    }

    public function pengajuanAdd() {
        $aju_model = $this->loadModel('pengajuan');
        $this->view->optKategori = $aju_model->GetOptKategori();
        $this->view->optProdi = $aju_model->GetOptProdi2();
        $this->view->renderDashboard('pengajuan/add');
    }

    public function detail($aju_id) {
        if (isset($aju_id)) {
            $aju_model = $this->loadModel('pengajuan');

            $this->view->optKategori = $aju_model->GetOptKategori();
            $this->view->optProdi = $aju_model->GetOptProdi();
            $this->view->aju = $aju_model->getAjuForDetail($aju_id);
            $this->view->renderDashboard('pengajuan/detail');
        } else {
            header('location: ' . URL . 'pengajuan');
        }
    }

    public function proses($aju_id) {
        if ($_SESSION['user_account_type'] == 3) {
            if (isset($aju_id)) {
                $aju_model = $this->loadModel('pengajuan');

                $this->view->optKategori = $aju_model->GetOptKategori();
                $this->view->optProdi = $aju_model->GetOptProdi();
                $this->view->aju = $aju_model->getAjuForDetail($aju_id);
                $this->view->renderDashboard('pengajuan/proses');
            } else {
                header('location: ' . URL . 'pengajuan/inbox');
            }
        } else {
            header('location: ' . URL . 'dashboard');
        }
    }

    public function saveProses($aju_id) {
        // 1. Ambil Post
        $_aju_terima = htmlspecialchars($_POST['aju_terima']);
        $_aju_komentar = htmlspecialchars($_POST['aju_komentar']);
        $_aju_pemeriksa = $_SESSION['user_nama_lengkap'];

        if ($_aju_terima == "") {
            $_aju_terima = NULL;
        }
        // 2. Arraykan
        $data_update = array(
            ':aju_terima' => $_aju_terima,
            ':aju_komentar' => $_aju_komentar,
            ':aju_pemeriksa' => $_aju_pemeriksa
        );

        // 3. Proses ke Model
        $aju_model = $this->loadModel('pengajuan');
        $aju_model->getAjuForProses($data_update, $aju_id);
        header('location: ' . URL . 'pengajuan/inbox');
    }

    public function saveAdd() {

        //$_SESSION["feedback_negative"] = NULL;
        $file_name = $_FILES['aju_file']['name'];
        $file_size = $_FILES['aju_file']['size'];
        $file_tmp = $_FILES['aju_file']['tmp_name'];
        $file_type = $_FILES['aju_file']['type'];

        if (isset($_FILES['aju_file']) && $file_size > 0) {

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
        $_aju_kat = htmlspecialchars($_POST['aju_kat_id']);
        $_aju_prodi = htmlspecialchars($_POST['aju_prodi_id']);
        $_aju_judul = htmlspecialchars($_POST['aju_judul']);
        $_aju_abstrak = htmlspecialchars($_POST['aju_abstrak']);

        // 2. Arraykan
        $data_insert = array(
            ':aju_kat_id' => $_aju_kat,
            ':aju_prodi_id' => $_aju_prodi,
            ':aju_judul' => $_aju_judul,
            ':aju_abstrak' => $_aju_abstrak,
            ':aju_filename' => $targetName
        );

        // 3. Proses ke Model
        if (!empty($_SESSION['user_name']) && !empty($_aju_kat) && !empty($_aju_prodi) && !empty($_aju_judul)) {
            $aju_model = $this->loadModel('pengajuan');
            $aju_model->getAjuForSave($data_insert);
        }
        header('location: ' . URL . 'pengajuan');
    }

}
