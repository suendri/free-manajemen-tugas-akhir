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

<h2>Inbox Pengajuan :: <?php echo $this->title; ?></h2>
<div class="row">
    <div class="col-md-3">
        <div class="metro-box">
            <a href="<?php echo URL; ?>pengajuan/inbox"><h1><span class="glyphicon glyphicon-inbox"></span></h1>Belum Diproses</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metro-box">
            <a href="<?php echo URL; ?>pengajuan/terima"><h1><span class="glyphicon glyphicon-thumbs-up"></span></h1>Diterima</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metro-box">
            <a href="<?php echo URL; ?>pengajuan/tolak"><h1><span class="glyphicon glyphicon-thumbs-down"></span></h1>Ditolak</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="metro-box">
            <a href="<?php echo URL; ?>pengajuan/semua"><h1><span class="glyphicon glyphicon-tasks"></span></h1>Judul Masuk</a>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="row">
    <div class="col-md-12">
        <form class="well" method="POST" action="<?php echo URL; ?>pengajuan/ajuCari">
            <div class="input-group">
                <input type="text" name="katakunci" value="" class="form-control" placeholder="Cari Judul" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                </span>
            </div>
        </form>
    </div>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Detail</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->ajus) {
            foreach ($this->ajus as $key => $value) {
                echo '<tr>';
                echo '<td><div><span class="text-primary">' . htmlspecialchars_decode($value->aju_judul) . '</span></div>
                            <div class="clear"></div>
                            <div>Kategori : <b>' . htmlentities($value->kat_nama) . '</b> &bull; Program Studi : <b>' . htmlentities($value->pro_nama) . '</b> &bull; Created : ' . htmlentities($value->aju_creation_date) . '</div></td>';
                echo '<td><a class="btn btn-primary btn-xs" href="' . URL . 'pengajuan/detail/' . $value->aju_id . '">Detail</a></td>';

                echo '<td>';
                if ($value->aju_terima == 'Y') {
                    echo '<span class="label label-success">Diterima</span>';
                } elseif ($value->aju_terima == 'N') {
                    echo '<span class="label label-danger">Ditolak</span>';
                } else {
                    echo '<a href="' . URL . 'pengajuan/proses/' . $value->aju_id . '" class="label label-warning">Proses</a>';
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
            echo "<li><a href='" . URL . "pengajuan/page/1'>First</a></li>";
            $prev = $this->page - 1;
            echo "<li><a href='" . URL . "pengajuan/page/$prev'>Previous</a></li>";
        }
        // --
        for ($i = ($this->page - $this->range); $i < ($this->page + $this->range); $i++) {
            if (($i > 0) && ($i <= $totalHalaman)) {
                if ($i == $this->page) {
                    echo "<li class='active'><a href=''>$i</a></li>";
                } else {
                    echo "<li><a href='" . URL . "pengajuan/page/$i'>$i</a></li>";
                }
            }
        }
        // --
        if ($this->page != $totalHalaman) {
            $next = $this->page + 1;
            echo "<li><a href='" . URL . "pengajuan/page/$next'>Next</a></li>";
            echo "<li><a href='" . URL . "pengajuan/page/$totalHalaman'>Last</a></li>";
        }
        // --
        echo "</ul>";
        ?>
        </div>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";