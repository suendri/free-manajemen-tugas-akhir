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
<h2>Avatar</h2>

<form class="form-horizontal well" method="POST" enctype="multipart/form-data" action="<?php echo URL; ?>dashboard/saveAvatar">
    <div class="form-group">
        <div class="col-md-12">
        <label>Pilih Gambar</label>         
            <input name="avatar_file" type="file" id="input_file" required="">
            <p class="help-block">Gambar type jpg atau png, maksimal 1 Mb. Ukuran yang disarankan 180x230 pixel.</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="submit" class="btn btn-primary" name="prcupload" value="Upload">
        </div>
    </div>
</form>
