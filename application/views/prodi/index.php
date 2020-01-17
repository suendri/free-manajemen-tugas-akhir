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

<h2>Program Studi <a class="btn btn-default" href="<?php echo URL; ?>prodi/add">Tambah Baru</a></h2>
<table class="table table-bordered" id="dtb">
    <thead>
        <tr>
            <th>#</th>
            <th>Program Studi</th>
            <th>KPS</th>
            <th>Aktif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->prodis) {
            $no = 1;
            foreach ($this->prodis as $key => $value) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . htmlentities($value->NM) . '</td>';
                echo '<td>' . htmlentities($value->KPS) . '</td>';
                echo '<td><img src="' . URL . '/public/images/' . $value->AKT . '.png"></td>';
                echo '<td><div class="btn-group">
                            <a class="btn btn-warning btn-xs" href="' . URL . 'prodi/edit/' . $value->ID . '"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="' . URL . 'prodi/delete/' . $value->ID . '" onclick="return confirm(\'Apakah anda yakin menghapus Program Studi ini? Proses tidak bisa dikembalikan\');"><span class="glyphicon glyphicon-trash"></span></a>
                        </div></td>';
                echo '</tr>';
                $no++;
            }
        }
        ?>
    </tbody>
</table>