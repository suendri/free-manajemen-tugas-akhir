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
<h2>Edit Kategori Dokumen</h2>

<?php if ($this->katdi) { ?>
    <form  class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>kategori/saveEdit/<?php echo $this->katdi->kat_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label">Kategori</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="kat_nama" value="<?php echo htmlentities($this->katdi->kat_nama); ?>" placeholder="Nama Kategori" required="">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label">Aktif</label>
            <div class="col-md-10">
                <?php $checked = $this->katdi->kat_aktif == 'Y' ? ' checked' : NULL; ?>
                <input type="checkbox" name="kat_aktif" value="Y" <?php echo $checked; ?>>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="prcedt" value="Simpan" />
                <a class="btn btn-primary" href="<?php echo URL; ?>kategori">Kembali</a>
            </div>
        </div>
    </form>
<?php } else { ?>
    <p>Data tidak ditemukan ! </p>
<?php
}