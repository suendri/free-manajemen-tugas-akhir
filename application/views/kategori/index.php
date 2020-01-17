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
<h2>Kategori Dokumen <a class="btn btn-default" href="<?php echo URL; ?>kategori/add">Tambah Baru</a></h2>
<table class="table table-bordered" id="dtb">
    <thead>
        <tr>
            <th>#</th>
            <th>Kategori</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->kategoris) {
            $no = 1;
            foreach ($this->kategoris as $key => $value) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . htmlentities($value->kat_nama) . '</td>';
                echo '<td><img src="' . URL . 'public/images/' . $value->kat_aktif . '.png"></td>';
                echo '<td><div class="btn-group">
                            <a class="btn btn-warning btn-xs" href="' . URL . 'kategori/edit/' . $value->kat_id . '"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="' . URL . 'kategori/delete/' . $value->kat_id . '" onclick="return confirm(\'Apakah anda yakin menghapus Kategori ini? Proses tidak bisa dikembalikan\');"><span class="glyphicon glyphicon-trash"></span></a>
                        </div></td>';
                echo '</tr>';
                $no++;
            }
        }
        ?>
    </tbody>
</table>