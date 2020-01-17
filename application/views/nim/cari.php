<?php 
/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

$this->renderFeedbackMessages(); 
$valueCari = isset($_SESSION['nimcari']) ? $_SESSION['nimcari'] : NULL;

?>
<h2>NIM <a class="btn btn-default" href="<?php echo URL; ?>nim/nimAdd">Tambah Baru</a></h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>nim/nimCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="<?php echo $valueCari; ?>" class="form-control" placeholder="Cari Nomor Induk" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                    <a class="btn btn-primary" href="<?php echo URL; ?>nim">Semua</a>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="alert alert-info">Hasil Pencarian Nomor Induk dengan kata kunci <b>"<?php echo $_SESSION['nimcari']; ?>"</b></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Induk</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->nims) {
            $no = 1;
            foreach ($this->nims as $key => $value) {
                if ($value->nim_aktif == 'N') {
                    $aktif = '<span class="label label-success">Bisa Digunakan</span>';
                } else {
                    $aktif = '<span class="label label-danger">Sudah Digunakan</span>';
                }
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . htmlentities($value->nim_no) . '</td>';
                echo '<td>' . $aktif . '</td>';
                echo '<td><a href="' . URL . 'user/delete/' . $value->nim_id . '" onclick="return confirm(\'Apakah anda yakin menghapus NIM ini?\');"><span class="glyphicon glyphicon-trash"></span></a></td>';
                echo '</tr>';
                $no++;
            }
        } 
        ?>
    </tbody>
</table>