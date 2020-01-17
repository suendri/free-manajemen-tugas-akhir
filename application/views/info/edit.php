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
<h2>Tambah Informasi</h2>
<?php if ($this->info) { ?>
<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>info/saveEdit/<?php echo $this->info->info_id; ?>">
    <div class="form-group">
        <label class="col-md-2 control-label">Program Studi</label>
        <div class="col-md-10">
            <select class="form-control" name="info_prodi_id" required="">
                    <?php
                    foreach ($this->optProdi as $key => $valueProdi) {
                        $selected = $this->info->info_prodi_id == $valueProdi->pro_id ? ' selected' : NULL;
                        ?>
                        <option value="<?php echo $valueProdi->pro_id; ?>" <?php echo $selected; ?>><?php echo $valueProdi->pro_nama; ?></option>
                    <?php } ?>
                </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-2 control-label">Judul *</label>
        <div class="col-md-10">
            <textarea name="info_judul" required=""><?php echo $this->info->info_judul; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Mulai *</label>
        <div class="col-md-6">
            <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                <input class="form-control" type="text" name="info_datem" value="<?php echo $this->info->info_datem; ?>" placeholder="Mulai Tanggal" readonly required="">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Selesai *</label>
        <div class="col-md-6">
            <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                <input class="form-control" type="text" name="info_dates" value="<?php echo $this->info->info_dates; ?>" placeholder="Mulai Tanggal" readonly required="">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Text *</label>
        <div class="col-md-10">
            <textarea name="info_text"><?php echo $this->info->info_text; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Aktif</label>
        <div class="col-md-10">
            <?php $checked = $this->info->info_aktif == 'Y' ? ' checked' : NULL; ?>
                <input type="checkbox" name="info_aktif" value="Y" <?php echo $checked; ?>>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>info">Kembali</a>
        </div>
    </div>
</form>
<?php }