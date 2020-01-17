<div class="row">
    <div class="col-md-12">
        <p class="text-right">Selamat Datang, <b><?php echo strtoupper($_SESSION['user_nama_lengkap']); ?></b></p>
    </div>
    <div class="col-md-2">
        <div class="isi-static desktop-only">
        <p>
            <a href="<?php echo URL; ?>dashboard/avatar">
                <img src="<?php echo Session::get('user_avatar'); ?>" class="img-thumbnail" width="170" height="200" alt="[IMG]">
            </a>
        <p>
        <div class="list-group"> 
			<?php if (Session::get('user_account_type') <= 2): ?>
            <a href="<?php echo URL; ?>pengajuan/info" class="list-group-item">Informasi</a>
            <?php endif; ?>
			
            <?php if (Session::get('user_account_type') == 3): ?>
            <a href="<?php echo URL; ?>info" class="list-group-item">Informasi</a>
            <a href="<?php echo URL; ?>pengajuan/inbox" class="list-group-item">Pengajuan</a>
            <a href="<?php echo URL; ?>pembimbing" class="list-group-item">Pembimbing</a>
            <?php endif; ?>
            
            <?php if (Session::get('user_account_type') == 4): ?>
            <a href="<?php echo URL; ?>pengajuan/info" class="list-group-item">Informasi</a>
            <a href="<?php echo URL; ?>pengajuan" class="list-group-item">Pengajuan</a>
            <?php endif; ?>
            <a href="<?php echo URL; ?>dashboard/profil" class="list-group-item">Akun</a>
        </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="isi-dash">
            <?php
            // Ref -- libs/View.php 
            require VIEWS_PATH . $filename . '.php';
            ?>
        </div> 
        <a href="http://gosoftware.web.id" target="_blank">Go Software Media</a> | gsSIMTA Versi <?php echo SISTEM_VERSI; ?>
    </div>
</div>