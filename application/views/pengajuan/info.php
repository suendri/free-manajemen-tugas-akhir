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
<h2>Informasi Pengajuan Judul</h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Program Studi</th>
            <th>Informasi</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Keterangan Tambahan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->infos) {
            foreach ($this->infos as $key => $value) {
                echo '<tr>';
                echo '<td>' . htmlentities($value->INM) . '</td>';
                echo '<td><span class="text-primary">' . htmlspecialchars_decode($value->IJDL) . '</span></td>';
                echo '<td style="width:100px;">' . $this->TanggalIndonesiaStrip($value->IDTM) . '</td>';
                echo '<td style="width:100px;">' . $this->TanggalIndonesiaStrip($value->IDTS) . '</td>';
                echo '<td>' . htmlspecialchars_decode($value->ITXT) . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>