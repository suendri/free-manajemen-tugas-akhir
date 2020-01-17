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

<h2>Informasi Pengajuan <a class="btn btn-default" href="<?php echo URL; ?>info/add">Tambah Baru</a></h2>

<div class="alert alert-info">
    Informasi ini sekaligus <b>BATAS AWAL</b> dan <b>BATAS AKHIR</b> pengajuan Judul bagi Mahasiswa dan hanya satu Informasi yang boleh aktif.
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Program Studi</th>
            <th>Informasi</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Keterangan Tambahan</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->infos) {
            foreach ($this->infos as $key => $value) {
                echo '<tr>';
                echo '<td>' . htmlentities($value->INM) . '</td>';
                echo '<td><a href="' . URL . 'info/edit/' . $value->ID . '">' . htmlspecialchars_decode($value->IJDL) . '</a></td>';
                echo '<td style="width:100px;">' . $this->TanggalIndonesiaStrip($value->IDTM) . '</td>';
                echo '<td style="width:100px;">' . $this->TanggalIndonesiaStrip($value->IDTS) . '</td>';
                echo '<td>' . htmlspecialchars_decode($value->ITXT) . '</td>';
                echo '<td><img src="' . URL . 'public/images/' . $value->IAKT . '.png"></td>';
                echo '<td><a class="btn btn-danger btn-xs" href="' . URL . 'info/delete/' . $value->ID . '" onclick="return confirm(\'Apakah anda yakin menghapus Data ini? Proses tidak bisa dikembalikan\');"><span class="glyphicon glyphicon-trash"></span></a></td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>