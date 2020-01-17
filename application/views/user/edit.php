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
<h2>Edit User</h2>

<?php if ($this->user) { ?>
    <form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>user/saveEdit/<?php echo $this->user->user_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label">Username</label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="user_name" value="<?php echo htmlentities($this->user->user_name); ?>" placeholder="Username" readonly=""/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Password</label>
            <div class="col-md-10">
                <input type="password" class="form-control" name="user_password" placeholder="Password" maxlength="20">
                <p class="help-block">Minimal 4 karakter dan Maksimal 20 karakter.</p>
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
                <input type="text" class="form-control" name="user_nama_lengkap" value="<?php echo htmlentities($this->user->user_nama_lengkap); ?>"  placeholder="Nama Lengkap" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Level</label>
            <div class="col-md-10">
                <?php
                $_strsw = '';
                $_strsx = '';
                $_strsy = '';
                $_strsz = '';

                if ($this->user->user_account_type == "1") {
                    $_strsw = 'checked';
                } elseif ($this->user->user_account_type == "2") {
                    $_strsx = 'checked';
                } elseif ($this->user->user_account_type == "3") {
                    $_strsy = 'checked';
                } else {
                    $_strsz = 'checked';
                }
                ?>
                <input type="radio" name="user_level" value="1" <?php echo $_strsw; ?> required=""> Administrator
                <input type="radio" name="user_level" value="2" <?php echo $_strsx; ?> required=""> Operator
                <input type="radio" name="user_level" value="3" <?php echo $_strsy; ?> required=""> Pemeriksa / KPS
                <input type="radio" name="user_level" value="4" <?php echo $_strsz; ?> required=""> Mahasiswa
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Aktif</label>
            <div class="col-md-10">
                <?php $checked = $this->user->user_active == 'Y' ? ' checked' : NULL; ?>
                <input type="checkbox" name="user_aktif" value="Y" <?php echo $checked; ?>>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="prcedt" value="Simpan" />
                <a class="btn btn-primary" href="<?php echo URL; ?>user">Kembali</a>
            </div>
        </div>
    </form>
<?php } else { ?>
    <p>Data tidak ditemukan ! </p>
    <?php
}