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
<h2>Tambah User</h2>

<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>user/saveAdd">
    <div class="form-group">
        <label class="col-md-2 control-label">Username</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="user_name" placeholder="Username" required="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Password</label>
        <div class="col-md-10">
            <input type="password" class="form-control" name="user_password" maxlength="20" placeholder="Password" required="">
            <p class="help-block">Minimal 4 karakter dan Maksimal 20 karakter.</p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="user_email"  placeholder="Alamat Email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Nama Lengkap</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="user_nama_lengkap" placeholder="Nama Lengkap" required="">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Level</label>
        <div class="col-md-10">
            <input type="radio" name="user_level" value="1" required=""> Administrator
            <input type="radio" name="user_level" value="2" required=""> Operator
            <input type="radio" name="user_level" value="3" required=""> Pemeriksa / KPS
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Aktif</label>
        <div class="col-md-10">
            <input type="checkbox" name="user_aktif" value="Y"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>user">Kembali</a>
        </div>
    </div>
</form>