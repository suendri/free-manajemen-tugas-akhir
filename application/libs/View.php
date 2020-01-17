<?php

/**
 * Class View
 *
 * Provides the methods all views will have
 */
class View {      

    public function render($filename) {
        // page without header and footer, for whatever reason
        require VIEWS_PATH . '_templates/header.php';
        require VIEWS_PATH . $filename . '.php';
        require VIEWS_PATH . '_templates/footer.php';
    }
    
    public function render_($filename) {
        // page without header and footer, for whatever reason
        require VIEWS_PATH . '_templates/_header.php';
        require VIEWS_PATH . $filename . '.php';
        require VIEWS_PATH . '_templates/footer.php';
    }

    // render template dashboard - phpbego
    public function renderDashboard($filename = "") {
        require VIEWS_PATH . '_templates/header.php';
        require VIEWS_PATH . '_templates/template.php';
        require VIEWS_PATH . '_templates/footer.php';
    }

    // render Ajax - phpbego
    public function renderAjax($filename = "") {
        require VIEWS_PATH . $filename . '.php';
    }

    // render template dashboard - phpbego
    public function renderPrint($filename = "") {
        require VIEWS_PATH . '_templates/print.php';
    }

    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages() {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require VIEWS_PATH . '_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

    /**
     * Checks if the passed string is the currently active controller.
     * Useful for handling the navigation's active/non-active link.
     * @param string $filename
     * @param string $navigation_controller
     * @return bool Shows if the controller is used or not
     */
    private function checkForActiveController($filename, $navigation_controller) {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];

        if ($active_controller == $navigation_controller) {
            return true;
        }
        // default return
        return false;
    }

    private function checkForActiveAction($filename, $navigation_action) {
        $split_filename = explode("/", $filename);
        $active_action = $split_filename[1];

        if ($active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }

    private function checkForActiveControllerAndAction($filename, $navigation_controller_and_action) {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];
        $active_action = $split_filename[1];

        $split_filename = explode("/", $navigation_controller_and_action);
        $navigation_controller = $split_filename[0];
        $navigation_action = $split_filename[1];

        if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }

    /*
     * Format Tanggal Indonesia
     */

    public function TanggalIndonesia($date) {
        $BulanIndo = array(
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember");

        $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $tgl = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

        $result = $tgl . " " . $BulanIndo[(int) $bulan - 1] . " " . $tahun;
        return($result);
    }

    /*
     * Format Tanggal Indonesia Strip
     */

    private function TanggalIndonesiaStrip($tgl) {
        $tanggal = substr($tgl, 8, 2);
        $bulan = substr($tgl, 5, 2);
        $tahun = substr($tgl, 0, 4);
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }    
    
}
