<script src="<?php echo URL; ?>public/js/bootstrap.filestyle.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        mode: "specific_textareas",
        height: "200",
        editor_selector: "MceEditor"
    });    
</script>

<?php
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 * entity_encoding : "raw"
 */
$this->renderFeedbackMessages();
?>
<h2>Tambah Repository</h2>

<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>repository/saveAdd" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-md-2 control-label">Collection ID</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="repo_cid" placeholder="Collection ID">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Nomor Induk</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="repo_nim" placeholder="Nomor Induk">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Nama Lengkap *</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="repo_nama" placeholder="Nama Lengkap" required="">
            <span class="help-block">Wajib Diisi.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Kategori *</label>
        <div class="col-md-10">
            <select class="form-control" name="repo_kat_id" required="">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($this->optKategori as $key => $valueKat) { ?>
                    <option value="<?php echo $valueKat->kat_id; ?>"><?php echo $valueKat->kat_nama; ?></option>
                <?php } ?>
            </select>
            <span class="help-block">Wajib Diisi.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Program Studi *</label>
        <div class="col-md-10">
            <select class="form-control" name="repo_prodi_id" required="">
                <option value="">-- Pilih Program Studi --</option>
                <?php foreach ($this->optProdi as $key => $valueProdi) { ?>
                    <option value="<?php echo $valueProdi->pro_id; ?>"><?php echo $valueProdi->pro_nama; ?></option>
                <?php } ?>
            </select>
            <span class="help-block">Wajib Diisi.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Judul *</label>
        <div class="col-md-10">
            <textarea name="repo_judul" id="JudulUC" class="form-control" required></textarea>
            <span class="help-block">Wajib Diisi.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Pembimbing 1</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="repo_pb1" placeholder="Pembimbing 1">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Pembimbing 2</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="repo_pb2" placeholder="Pembimbing 2">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Abstrak</label>
        <div class="col-md-10">
            <textarea name="repo_abstrak" class="MceEditor"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">File</label>
        <div class="col-md-10">
            <input name="repo_file" type="file" id="input_file" class="filestyle" data-icon="false" data-buttonName="btn-primary">
            <p class="help-block">Tipe File .PDF, maksimal 5 MB.</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>repository">Kembali</a>
        </div>
    </div>
</form>