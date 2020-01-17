<h2>Dashboard</h2>
<div class="panel panel-default">
    <div class="panel-heading">
        <b>
            <?php echo strtoupper($_SESSION['user_nama_lengkap']); ?>
            <?php if (Session::get('user_account_type') == 3): ?>
                - Anda Memiliki <span class="badge"> <?php echo $this->aju; ?> </span> Pengajuan Baru Belum Diproses.
            <?php endif; ?>
        </b>
    </div>
    <div class="panel-body">
        Selamat Datang di <?php echo SISTEM_NAMA_ . " " . SISTEM_INSTANSI_NAMA; ?>. 
        Gunakan akun anda sebaik-baiknya, hindari kesalahan pada saat proses Input. Bacalah Panduan 
        Input untuk lebih lanjut.
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><b>REPOSITORY TERBARU</b></div>
    <div class="panel-body"></div>
    <table class="table table-hover">
        <?php
        if ($this->rts) {
            foreach ($this->rts as $key => $value) {
                echo '<tr>';
                echo '<td><blockquote><span class="text-primary">' . htmlspecialchars_decode($value->repo_judul) . '</span></blockquote>
                            <div>' . htmlentities($value->kat_nama) . ' - <b>' . htmlentities($value->repo_nama) . '</b> (' . htmlentities($value->repo_nim) . ').</div>
                            <div>Program Studi : <b>' . htmlentities($value->pro_nama) . '</b>. Published : ' . htmlentities($value->repo_date) . ' &middot; <b>' . htmlentities($value->repo_hit) . '</b> views</div>';
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</div>