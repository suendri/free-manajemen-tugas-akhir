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

<h2>Nomor Induk <a class="btn btn-default" href="<?php echo URL; ?>nim/nimAdd">Tambah Baru</a></h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>nim/nimCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="" class="form-control" placeholder="Cari Nomor Induk" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                </span>
            </div>
        </form>
    </div>
</div>
<div class="clear"></div>
<table class="table table-hover">
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
            foreach ($this->nims as $key => $value) {
                if ($value->nim_aktif == 'N') {
                    $aktif = '<span class="label label-success">Bisa Digunakan</span>';
                    $hapus = '<a href="' . URL . 'nim/delete/' . $value->nim_id . '" onclick="return confirm(\'Apakah anda yakin menghapus NIM ini?\');"><span class="glyphicon glyphicon-trash"></span></a>';
                } else {
                    $aktif = '<span class="label label-danger">Sudah Digunakan</span>';
                    $hapus = "";
                }
                echo '<tr>';
                echo '<td>' . htmlentities($value->nim_id) . '</td>';
                echo '<td>' . htmlentities($value->nim_no) . '</td>';
                echo '<td>' . $aktif . '</td>';
                echo '<td>' . $hapus . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        <div class="text-center">
        <?php
        $totalHalaman = ceil($this->total / $this->position);
        echo "<ul class='pagination'>";
        // --
        if ($this->page > 1) {
            echo "<li><a href='" . URL . "nim/page/1'>First</a></li>";
            $prev = $this->page - 1;
            echo "<li><a href='" . URL . "nim/page/$prev'>Previous</a></li>";
        }
        // --
        for ($i = ($this->page - $this->range); $i < (($this->page + $this->range) + 1); $i++) {
            if (($i > 0) && ($i <= $totalHalaman)) {
                if ($i == $this->page) {
                    echo "<li class='active'><a href=''>$i</a></li>";
                } else {
                    echo "<li><a href='" . URL . "nim/page/$i'>$i</a></li>";
                }
            }
        }
        // --
        if ($this->page != $totalHalaman) {
            $next = $this->page + 1;
            echo "<li><a href='" . URL . "nim/page/$next'>Next</a></li>";
            echo "<li><a href='" . URL . "nim/page/$totalHalaman'>Last</a></li>";
        }
        // --
        echo "</ul>";
        ?>
        </div>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";
