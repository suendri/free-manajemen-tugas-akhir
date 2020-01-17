<h2>Laporan Pengajuan Diterima</h2>
<h5><a class="btn btn-default" href="#" onClick="NewWin=window.open('<?php echo URL . "laporan/printTerima"; ?>','NewWin','toolbar=no,status=no,width=1350,height=500,scrollbars=yes');"><span class="glyphicon glyphicon-print"></span> Cetak</a> <a class="btn btn-default" href="<?php echo URL; ?>laporan">Tutup</a> | Tanggal : <b><?php echo $this->TanggalIndonesiaStrip($_SESSION['tgl_awal']); ?></b> s/d <b><?php echo $this->TanggalIndonesiaStrip($_SESSION['tgl_akhir']); ?></b> 
</h5>

<?php if ($this->laporans) { ?>
    <table class="table table-bordered">
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>JUDUL</th>
        </tr>
        <?php
        $no = 1;
        foreach ($this->laporans as $key => $value) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo htmlentities($value->aju_user); ?></td>
                <td><?php echo htmlentities($value->user_nama_lengkap); ?></td>
                <td><span class="text-primary"><?php echo htmlentities($value->aju_judul); ?></span></td>
            </tr>
            <?php
            $no++;
        }
        ?>

    </table>
<?php } else { ?>
    <p>Data tidak ditemukan !</p>
    <?php
}  