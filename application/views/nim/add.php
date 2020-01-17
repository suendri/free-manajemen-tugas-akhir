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
<h2>Tambah Nomor Induk</h2>

<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>nim/saveAdd">
    <div class="form-group">
        <label class="col-md-2 control-label">Nomor Induk</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="nim_no" placeholder="Nomor Induk Mahasiswa" required="">
        </div>
    </div>    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>nim">Kembali</a>
        </div>
    </div>
</form>