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

<h2>Repository <?php if ($_SESSION['user_account_type'] <= 2) { ?><a class="btn btn-default" href="<?php echo URL; ?>repository/repoAdd">Tambah Baru</a> <?php } ?></h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>repository/repoCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="" class="form-control" pattern="[a-zA-Z0-9\s]+" placeholder="Cari Judul Repository" required="">
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
                        <blockquote><a href="' . URL . 'repository/detail/' . $value->repo_id . '">' . strtoupper(htmlspecialchars_decode($value->repo_judul)) . '</a></blockquote>
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
        <div class="text-center">
            <?php
            $totalHalaman = ceil($this->total / $this->position);

            echo "<ul class='pagination'>";
            // --
            if ($this->page > 1) {
                echo "<li><a href='" . URL . "repository/page/1'>First</a></li>";
                $prev = $this->page - 1;
                echo "<li><a href='" . URL . "repository/page/$prev'>Previous</a></li>";
            }
            // --
            for ($i = ($this->page - $this->range); $i < ($this->page + $this->range); $i++) {
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
                echo "<li><a href='" . URL . "repository/page/$next'>Next</a></li>";
                echo "<li><a href='" . URL . "repository/page/$totalHalaman'>Last</a></li>";
            }
            // --
            echo "</ul>";
            ?>
        </div>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";
