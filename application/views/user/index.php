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

<h2>Users <a class="btn btn-default" href="<?php echo URL; ?>user/add">Tambah Baru</a></h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>user/userCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="" class="form-control" pattern="[a-zA-Z0-9\s]+" placeholder="Cari User" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                </span>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>Level</th>
            <th>Aktif</th>
            <th>Act</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->users) {
            $no = 1;
            foreach ($this->users as $key => $value) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . htmlentities($value->user_name) . '</td>';
                echo '<td>' . htmlentities($value->user_email) . '</td>';
                echo '<td>' . htmlentities($value->user_nama_lengkap) . '</td>';
                echo '<td>' . htmlentities($value->user_account_type) . '</td>';
                echo '<td><img src="' . URL . 'public/images/' . $value->user_active . '.png"></td>';
                echo '<td><div class="btn-group">
                            <a class="btn btn-warning btn-xs" href="' . URL . 'user/edit/' . $value->user_id . '"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="' . URL . 'user/delete/' . $value->user_id . '" onclick="return confirm(\'Apakah anda yakin menghapus user ini?\');"><span class="glyphicon glyphicon-trash"></span></a>
                        </div></td>';
                echo '</tr>';
                $no++;
            }
        } else {
            echo 'Tidak ada data !';
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
                echo "<li><a href='" . URL . "user/page/1'>First</a></li>";
                $prev = $this->page - 1;
                echo "<li><a href='" . URL . "user/page/$prev'>Previous</a></li>";
            }
            // --
            for ($i = ($this->page - $this->range); $i < ($this->page + $this->range); $i++) {
                if (($i > 0) && ($i <= $totalHalaman)) {
                    if ($i == $this->page) {
                        echo "<li class='active'><a href=''>$i</a></li>";
                    } else {
                        echo "<li><a href='" . URL . "user/page/$i'>$i</a></li>";
                    }
                }
            }
            // --
            if ($this->page != $totalHalaman) {
                $next = $this->page + 1;
                echo "<li><a href='" . URL . "user/page/$next'>Next</a></li>";
                echo "<li><a href='" . URL . "user/page/$totalHalaman'>Last</a></li>";
            }
            // --
            echo "</ul>";
            ?>
        </div>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";