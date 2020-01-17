<?php 
/*
 * --
 * PHPBeGO Foundation - GoSoftware Media 2014
 * http://phpbego.wordpress.com
 * http://www.gosoftware.web.id
 * --
 */
$this->renderFeedbackMessages(); 
$valueCari = isset($_SESSION['repocari']) ? $_SESSION['repocari'] : NULL;

?>
<h2>Pencarian Repository</h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>repository/repoCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="<?php echo $valueCari; ?>" class="form-control" pattern="[a-zA-Z0-9\s]+" placeholder="Cari Judul Repository" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                    <a class="btn btn-primary" href="<?php echo URL; ?>repository">Semua</a>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="alert alert-info">Hasil Pencarian Judul dengan kata kunci <b>"<?php echo $_SESSION['repocari']; ?>"</b></div>
<div class="clear"></div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Judul Repository</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->repos) {
            foreach ($this->repos as $key => $value) {
                echo '<tr>';
                echo '<td>
                        <div><a href="' . URL . 'repository/detail/' . $value->repo_id . '">' . htmlspecialchars_decode($value->repo_judul) . '</a></div>
                        <div>' . htmlentities($value->kat_nama) . ' - <b>' . htmlentities($value->repo_nama) . '</b> (' . htmlentities($value->repo_nim) . ').</div>
                        <div>Program Studi : <b>' . htmlentities($value->pro_nama) . '</b>. Published : ' . htmlentities($value->repo_date) . ' &middot; <b>' . htmlentities($value->repo_hit) . '</b> views</div>';
                echo '</td>';
                echo '<td style="width: 80px;">';
                if ($_SESSION['user_account_type'] <= 2) {
                    echo '<div class="clear"></div>
                            <div class="btn-group">
                                <a class="btn btn-warning btn-xs" href="' . URL . 'repository/repoEdit/' . $value->repo_id . '"><span class="glyphicon glyphicon-edit"></a>
                                <a class="btn btn-danger btn-xs" href="' . URL . 'repository/delete/' . $value->repo_id . '" onclick="return confirm(\'Apakah anda yakin menghapus Judul ini? Proses tidak bisa dikembalikan\');"><span class="glyphicon glyphicon-trash"></a>
                            </div>';
                }
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        <?php
        $totalHalaman = ceil($this->total / $this->position);
        echo "<ul class='pagination'>";
        // --
        if ($this->page > 1) {
            echo "<li><a href='" . URL . "repository/page/1'><<</a></li>";
            $prev = $this->page - 1;
            echo "<li><a href='" . URL . "repository/page/$prev'><</a></li>";
        }
        // --
        for ($i = ($this->page - $this->range); $i < (($this->page + $this->range) + 1); $i++) {
            if (($i > 0) && ($i <= $totalHalaman)) {
                if ($i == $this->page) {
                    echo "<li class='active'><a href=''>$i</a></li>";
                } else {
                    echo "<li><a href='" . URL . "repository/page/$i'>$i</a></li>";
                }
            }
        }
        // --
        if ($this->page != $totalHalaman) {
            $next = $this->page + 1;
            echo "<li><a href='" . URL . "repository/page/$next'>></a></li>";
            echo "<li><a href='" . URL . "repository/page/$totalHalaman'>>></a></li>";
        }
        // --
        echo "</ul>";
        ?>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";
