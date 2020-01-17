<div class="row">
    <div class="col-md-3">
        <div class="isi">
            <form class="login" role="form" method="POST" action="<?php echo URL; ?>index/login">
                <div class="form-group">
                    <label>Login Sistem</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Username" required="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="user_password" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="prclogin" value="Login">
                </div>
                 <div class="form-group">
                     Belum Punya Akun? <a href="<?php echo URL; ?>index/daftar">Daftar</a>
                </div>

                <?php $this->renderFeedbackMessages(); ?>
            </form>    
        </div>
    </div>
    <div class="col-md-9">
        <div class="title-top">
            <h1><?php echo SISTEM_NAMA; ?></h1>
            <div>Selamat Datang di <?php echo SISTEM_NAMA_; ?>,</div>
            <div><?php echo SISTEM_INSTANSI_NAMA_LENGKAP2; ?>.</div>
            <div><?php echo SISTEM_INSTANSI_NAMA_LENGKAP; ?> - Sumatera Utara.</div>
            <div class="title-top-cr">Copyright 2014. <a href="http://gosoftware.web.id" target="_blank">Go Software Media</a></div>
        </div>
    </div>
</div>