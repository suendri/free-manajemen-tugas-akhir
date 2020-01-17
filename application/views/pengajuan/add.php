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
<h2>Pengajuan Judul Baru</h2>

<div class="alert alert-info">
    Lengkapi Form berikut dengan teliti untuk Pengajuan Judul Baru. Pastikan data yang
    anda masukkan telah anda periksa ulang. Data yang dikirim tidak bisa ditarik dan
    diperbaiki kembali. Pilihan Program Studi akan muncul jika Jadwal Pengajuan telah dibuka.
</div>

<form class="form-horizontal" role="form" data-toggle="validator" method="post" action="<?php echo URL; ?>pengajuan/saveAdd" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-md-2 control-label">Kategori *</label>
        <div class="col-md-10">
            <select class="form-control" name="aju_kat_id" required>    
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
            <select class="form-control" name="aju_prodi_id" required>
                <option value="">-- Pilih Program Studi --</option>
                <?php foreach ($this->optProdi as $key => $valueProdi) { ?>
                    <option value="<?php echo $valueProdi->ID; ?>"><?php echo $valueProdi->NM; ?></option>
                <?php } ?>
            </select>
            <span class="help-block">Wajib Diisi.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Judul *</label>
        <div class="col-md-10">
            <textarea name="aju_judul" id="JudulUC" class="form-control" required></textarea>
            <span class="help-block">Wajib Diisi, Gunakan Huruf KAPITAL untuk lebih bagus.</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Abstrak</label>
        <div class="col-md-10">
            <textarea name="aju_abstrak" class="MceEditor"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">File</label>
        <div class="col-md-10">
            <input name="aju_file" type="file" id="input_file" class="filestyle" data-icon="false" data-buttonName="btn-primary">
            <p class="help-block">Tipe File .PDF, maksimal 5 MB. File boleh kosong jika tidak diperlukan.</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Kirim Pengajuan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>pengajuan">Kembali</a>
        </div>
    </div>
</form>