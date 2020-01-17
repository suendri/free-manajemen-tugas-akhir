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

<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>info/saveAdd">
    <div class="form-group">
        <label class="col-md-2 control-label">Program Studi</label>
        <div class="col-md-10">
            <select class="form-control" name="info_prodi_id" required="">
                <?php foreach ($this->optProdi as $key => $valueProdi) { ?>
                    <option value="<?php echo $valueProdi->pro_id; ?>"><?php echo $valueProdi->pro_nama; ?></option>
                <?php } ?>
            </select>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-2 control-label">Judul *</label>
        <div class="col-md-10">
            <textarea name="info_judul" required=""></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Mulai *</label>
        <div class="col-md-6">
            <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                <input class="form-control" type="text" name="info_datem" value="" placeholder="Mulai Tanggal" readonly required="">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Selesai *</label>
        <div class="col-md-6">
            <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                <input class="form-control" type="text" name="info_dates" value="" placeholder="Mulai Tanggal" readonly required="">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Text *</label>
        <div class="col-md-10">
            <textarea name="info_text"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Aktif</label>
        <div class="col-md-10">
            <input type="checkbox" name="info_aktif" value="Y"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>info">Kembali</a>
        </div>
    </div>
</form>