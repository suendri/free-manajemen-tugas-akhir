<?php
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */
$this->renderFeedbackMessages();
$link = $_SESSION['user_account_type'] == 4 ? "pengajuan" : "pengajuan/inbox";
?>
<h2>Detail Pengajuan Judul <a class="btn btn-default" href="<?php echo URL . $link; ?>">Kembali</a></h2>

<?php if ($this->aju) { ?>
    <div class="row">
        <div class="col-md-2"><b>Nomor Induk</b></div>
        <div class="col-md-10">
            <?php echo htmlentities($this->aju->aju_user); ?>
        </div>

        <div class="col-md-2"><b>Nama Lengkap</b></div>
        <div class="col-md-10">
            <?php echo htmlentities($this->aju->user_nama_lengkap); ?>
        </div>

        <div class="col-md-2"><b>Kategori</b></div>
        <div class="col-md-10">
            <?php echo htmlentities($this->aju->kat_nama); ?>
        </div>

        <div class="col-md-2"><b>Program Studi</b></div>
        <div class="col-md-10">
            <?php echo htmlentities($this->aju->pro_nama); ?>
        </div>

        <div class="col-md-2"><b>Judul</b></div>
        <div class="col-md-10">
            <blockquote><span class="text-primary"><?php echo strtoupper(htmlspecialchars_decode($this->aju->aju_judul)); ?></span></blockquote>
        </div>

        <div class="col-md-2"><b>Abstrak</b></div>
        <div class="col-md-10">
            <blockquote><i><?php echo htmlspecialchars_decode($this->aju->aju_abstrak); ?></i></blockquote>
        </div>

        <div class="col-md-2"><b>Diajukan</b></div>
        <div class="col-md-10">
            <?php echo htmlspecialchars_decode($this->aju->aju_creation_date); ?>
        </div>

        <div class="col-md-2"><b>Status</b></div>
        <div class="col-md-10">
            <?php
            if ($this->aju->aju_terima == 'Y') {
                echo '<span class="label label-success">Diterima</span>';
            } elseif ($this->aju->aju_terima == 'N') {
                echo '<span class="label label-danger">Ditolak</span>';
            } else {
                echo '<span class="label label-warning">Belum Diproses</span>';
            }
            ?>
            <div class="clear"></div>
        </div>

        <div class="col-md-2"><b>Pemeriksa</b></div>
        <div class="col-md-10">
            <div class="alert alert-info"><?php echo htmlspecialchars($this->aju->aju_pemeriksa); ?></div>
        </div>

        <div class="col-md-2"><b>Komentar</b></div>
        <div class="col-md-10">
            <div class="alert alert-info"><?php echo htmlspecialchars_decode($this->aju->aju_komentar); ?></div>
        </div>

        <div class="col-md-2"><b>Diperiksa</b></div>
        <div class="col-md-10">
            <div class="alert alert-info"><?php echo htmlspecialchars($this->aju->aju_tglperiksa); ?></div>
        </div>

        <div class="col-md-2"><b>File</b></div>
        <div class="col-md-10">
            <?php if (($this->aju->aju_filename != "") && file_exists(FILES_PATH . $this->aju->aju_filename)) { ?>
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat</button>

                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">File</h4>
                            </div>
                            <div class="modal-body">
                                <iframe style="width:100%;height:500px" src="<?php echo URL; ?>public/pdfjs/web/viewer.php?file=<?php echo URL . FILES_PATH . htmlspecialchars($this->aju->aju_filename); ?>"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary btn-xs" href="<?php echo URL . FILES_PATH . htmlspecialchars($this->aju->aju_filename); ?>">Download</a> <small><i>[Disable Internet Download Manager (IDM) Untuk Live Preview]</i></small>
            <?php
            } else {
                echo '<span class="label label-danger">File tidak ditemukan!</span>';
            }
            ?>
        </div>
    </div>
    <?php
}