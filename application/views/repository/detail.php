<?php
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */
$this->renderFeedbackMessages();
?>
<h2>Detail Repository <a class="btn btn-default" href="<?php echo URL; ?>repository">Kembali</a></h2>

<?php if ($this->repo) { ?>
    <div class="row">
        <div class="col-md-2"><b>Collection ID</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->repo_cid); ?>
        </div>
        <div class="col-md-2"><b>Nomor Induk</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->repo_nim); ?>
        </div>
        <div class="col-md-2"><b>Nama Lengkap</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->repo_nama); ?>
        </div>
        <div class="col-md-2"><b>Kategori</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->kat_nama); ?>
        </div>

        <div class="col-md-2"><b>Program Studi</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->pro_nama); ?>
        </div>
        <div class="col-md-2"><b>Judul</b></div>
        <div class="col-md-10">
            <blockquote><span class="text-primary"><?php echo strtoupper(htmlspecialchars_decode($this->repo->repo_judul)); ?></span></blockquote>
        </div>        
        <div class="col-md-2"><b>Abstrak</b></div>
        <div class="col-md-10">
            <blockquote><i><?php echo htmlspecialchars_decode($this->repo->repo_abstrak); ?></i></blockquote>
        </div>
        <div class="col-md-2"><b>Pembimbing 1</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->repo_pmmb1); ?>
        </div>
        <div class="col-md-2"><b>Pembimbing 2</b></div>
        <div class="col-md-10">
            : <?php echo htmlentities($this->repo->repo_pmmb2); ?>
        </div>
        <div class="col-md-2"><b>File</b></div>
        <div class="col-md-10">
            <?php if (($this->repo->repo_file != "") && file_exists(FILES_PATH . $this->repo->repo_file)) { ?>
             <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">Lihat</button>

            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">File</h4>
                        </div>
                        <div class="modal-body">
                            <iframe style="width:100%;height:500px" src="<?php echo URL; ?>public/pdfjs/web/viewer.php?file=<?php echo URL . FILES_PATH . htmlspecialchars($this->repo->repo_file); ?>"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary btn-xs" href="<?php echo URL . FILES_PATH . htmlspecialchars($this->repo->repo_file); ?>">Download</a> <small><i>[Disable Internet Download Manager (IDM) Untuk Live Preview]</i></small>
            <?php } else { echo '<span class="label label-danger">File tidak ditemukan!</div>'; } ?>
        </div>
    </div>
    <?php
}