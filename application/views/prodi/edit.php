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
<h2>Edit Program Studi</h2>

<?php if ($this->prodi) { ?>
    <form  class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>prodi/saveEdit/<?php echo $this->prodi->pro_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label">Program Studi</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="pro_nama" value="<?php echo htmlentities($this->prodi->pro_nama); ?>" placeholder="Program Studi" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Kepala PS</label>
            <div class="col-md-10">
                <select class="form-control" name="repo_kat_id" required="">
                    <option value="">-- Pilih Kepala PS --</option>
                    <?php
                    foreach ($this->optKps as $key => $valueKps) {
                        $selected = $this->prodi->pro_user == $valueKps->user_name ? ' selected' : NULL;
                        ?>
                        <option value="<?php echo $valueKps->user_name; ?>" <?php echo $selected; ?>><?php echo $valueKps->user_nama_lengkap; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Aktif</label>
            <div class="col-md-10">
                <?php $checked = $this->prodi->pro_aktif == 'Y' ? ' checked' : NULL; ?>
                <input type="checkbox" name="pro_aktif" value="Y" <?php echo $checked; ?>>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="prcedt" value="Simpan" />
                <a class="btn btn-primary" href="<?php echo URL; ?>prodi">Kembali</a>
            </div>
        </div>
    </form>
<?php } else { ?>
    <p>Data tidak ditemukan ! </p>
    <?php
}