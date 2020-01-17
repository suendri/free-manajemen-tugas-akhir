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
<h2>Tambah Kategori</h2>

<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>kategori/saveAdd">
    <div class="form-group">
        <label class="col-md-2 control-label">Nama</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="kat_nama" placeholder="Nama Kategori Dokumen" required="">
        </div>
    </div>    
    <div class="form-group">
        <label class="col-md-2 control-label">Aktif</label>
        <div class="col-md-10">
            <input type="checkbox" name="kat_aktif" value="Y"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>kategori">Kembali</a>
        </div>
    </div>
</form>