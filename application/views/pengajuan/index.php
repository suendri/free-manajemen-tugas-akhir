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

<h2>Pengajuan Judul <a class="btn btn-default" href="<?php echo URL; ?>pengajuan/pengajuanAdd">Tambah Pengajuan Judul Baru</a></h2>

<table class="table table-hover" id="dtb">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Detail</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->ajus) {
            $no = 1;
            foreach ($this->ajus as $key => $value) {
                echo '<tr>';
                echo '<td><div>' . $no . '</div>';
                echo '<td><div><span class="text-primary">' . strtoupper(htmlspecialchars_decode($value->aju_judul)) . '</span></div>
                            <div class="clear"></div>
                            <div>Kategori : <b>' . htmlentities($value->kat_nama) . '</b> &bull; Program Studi : <b>' . htmlentities($value->pro_nama) . '</b> &bull; Created : ' . htmlentities($value->aju_creation_date) . '</div></td>';
                echo '<td><a class="btn btn-primary btn-xs" href="' . URL . 'pengajuan/detail/' . $value->aju_id . '">Detail</a></td>';

                echo '<td>';
                if ($value->aju_terima == 'Y') {
                    echo '<span class="label label-success">Diterima</span>';
                } elseif ($value->aju_terima == 'N') {
                    echo '<span class="label label-danger">Ditolak</span>';
                } else {
                    echo '<span class="label label-warning">Belum Diproses</span>';
                }
                echo '</td>';
                echo '</tr>';
                $no++;
            }
        }
        ?>
    </tbody>
</table>