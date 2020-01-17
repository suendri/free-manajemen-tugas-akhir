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
<h2>Profil</h2>

<?php if ($this->user) { ?>
    <form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>dashboard/saveProfil/<?php echo $_SESSION['user_id']; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label">Username</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="user_name" value="<?php echo htmlentities($this->user->user_name); ?>" placeholder="Username" readonly="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Password</label>
            <div class="col-md-10">
                <input type="password" class="form-control" name="user_password" placeholder="Password" maxlength="20"/>
                <p class="help-block">Minimal 4 karakter dan Maksimal 20 karakter, Biarkan kosong jika tidak ada perobahan.</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Email</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="user_email" value="<?php echo htmlentities($this->user->user_email); ?>"  placeholder="Alamat Email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nama Lengkap</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="user_nama_lengkap" value="<?php echo htmlentities($this->user->user_nama_lengkap); ?>"  placeholder="Nama Lengkap" required=""/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            </div>
        </div>
    </form>
<?php } else { ?>
    <p>Data tidak ditemukan ! </p>
<?php
}
