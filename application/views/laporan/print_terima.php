<div class="text-center">
    <h2><?php echo SISTEM_INSTANSI_NAMA_LENGKAP2; ?></h2>
    <h2><?php echo SISTEM_INSTANSI_NAMA_LENGKAP; ?></h2>
    <h4>DAFTAR PENGAJUAN JUDUL KARYA ILMIAH DITERIMA</h4>
    Tanggal : <b><?php echo $this->TanggalIndonesiaStrip($_SESSION['tgl_awal']); ?></b> s/d <b><?php echo $this->TanggalIndonesiaStrip($_SESSION['tgl_akhir']); ?></b>
</div>
<hr>
<?php if ($this->laporans) { ?>
    <table class="table-dotted">
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th style="min-width: 150px">NAMA</th>
            <th>JUDUL</th>
            <th style="width: 100px">KATEGORI</th>
            <th>PEMBIMBING-1</th>
            <th>PEMBIMBING-2</th>
        </tr>
        <?php
        $no = 1;
        foreach ($this->laporans as $key => $value) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo htmlentities($value->aju_user); ?></td>
                <td><?php echo htmlentities($value->user_nama_lengkap); ?></td>
                <td><?php echo htmlentities($value->aju_judul); ?></td>
                <td><?php echo htmlentities($value->kat_nama); ?></td>
                <td><?php echo htmlentities($value->aju_pmmb1); ?></td>
                <td><?php echo htmlentities($value->aju_pmmb2); ?></td>
            </tr>
            <?php
            $no++;
        }
        ?>

    </table>
<p><i>Sumber http://simta.royal.ac.id</i></p>
<?php } else { ?>
    <p>Data tidak ditemukan !</p>
    <?php
}  