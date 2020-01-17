<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        height: "200"
    });
</script>
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
<h2>Proses Judul</h2>

<?php if ($this->aju) { ?>
    <form class="form-horizontal" role="form" method="post" action="<?php echo URL; ?>pengajuan/saveProses/<?php echo $this->aju->aju_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label">Nomor Induk</label>
            <div class="col-md-10">
                <?php echo htmlentities($this->aju->aju_user); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nama Lengkap</label>
            <div class="col-md-10">
                <?php echo htmlentities($this->aju->user_nama_lengkap); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Kategori</label>
            <div class="col-md-10">
                <?php echo htmlentities($this->aju->kat_nama); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Program Studi</label>
            <div class="col-md-10">
                <?php echo htmlentities($this->aju->pro_nama); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Judul</label>
            <div class="col-md-10">
                <textarea name="aju_judul"><?php echo htmlspecialchars_decode($this->aju->aju_judul); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Abstrak</label>
            <div class="col-md-10">
                <textarea name="repo_abstrak"><?php echo htmlspecialchars_decode($this->aju->aju_abstrak); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Diajukan</label>
            <div class="col-md-10">
                <?php echo htmlspecialchars_decode($this->aju->aju_creation_date); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Status</label>
            <div class="col-md-10">
                <select class="form-control" name="aju_terima">
                    <option value="">- Pilih Status -</option>
                    <option value="Y">Terima</option>
                    <option value="N">Tolak</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Komentar</label>
            <div class="col-md-10">
                <textarea name="aju_komentar"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" name="prcnew" value="Simpan" />
                <a class="btn btn-danger" href="<?php echo URL; ?>pengajuan/inbox">Batal</a>
            </div>
        </div>
    </div>
    </form>
    <?php
}