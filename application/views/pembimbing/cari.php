<?php 
/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

$this->renderFeedbackMessages(); 
$valueCari = isset($_SESSION['pmmbcari']) ? $_SESSION['pmmbcari'] : NULL;

?>

<h2>Cari Mahasiswa</h2>
<div class="row">
    <div class="col-md-6">
        <form method="POST" action="<?php echo URL; ?>pembimbing/cari">
            <div class="input-group">
                <input type="text" name="katakunci"  value="<?php echo $valueCari; ?>" class="form-control" pattern="[a-zA-Z0-9\s]+" placeholder="Cari Nomor Induk atau Nama" required="">
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" value="Cari">
                    <a class="btn btn-primary" href="<?php echo URL; ?>pembimbing">Semua</a>
                </span>
            </div>
        </form>
    </div>
</div>
<div class="alert alert-info">
    Mahasiswa dalam daftar berikut adalah pemilik judul yang sudah diterima,
    silakan proses di menu Pengajuan jika tidak ditemukan.
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>NIM</th>
            <th style="min-width: 150px">Nama</th>
            <th>Judul</th>
            <th style="width: 100px">Kategori</th>
            <th>Proses</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($this->ajus) {
            foreach ($this->ajus as $key => $value) {
                echo '<tr>';
                echo '<td>' . htmlentities($value->aju_user) . '</td>';
                echo '<td>' . htmlentities($value->user_nama_lengkap) . '</td>';
                echo '<td><span class="text-primary">' . strtoupper(htmlspecialchars_decode($value->aju_judul)) . '</span></td>';
                echo '<td>' . htmlentities($value->kat_nama) . '</td>';
                echo '<td><a class="btn btn-warning btn-xs" href="' . URL . 'pembimbing/edit/' . $value->aju_id . '">Proses</a></td>';
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
            echo "<li><a href='" . URL . "pembimbing/page/1'>First</a></li>";
            $prev = $this->page - 1;
            echo "<li><a href='" . URL . "pembimbing/page/$prev'>Previous</a></li>";
        }
        // --
        for ($i = ($this->page - $this->range); $i < (($this->page + $this->range) + 1); $i++) {
            if (($i > 0) && ($i <= $totalHalaman)) {
                if ($i == $this->page) {
                    echo "<li class='active'><a href=''>$i</a></li>";
                } else {
                    echo "<li><a href='" . URL . "pembimbing/page/$i'>$i</a></li>";
                }
            }
        }
        // --
        if ($this->page != $totalHalaman) {
            $next = $this->page + 1;
            echo "<li><a href='" . URL . "pembimbing/page/$next'>Next</a></li>";
            echo "<li><a href='" . URL . "pembimbing/page/$totalHalaman'>Last</a></li>";
        }
        // --
        echo "</ul>";
        ?>
        </div>
    </div>
</div>
<?php
echo "Halaman <b>$this->page</b> dari Total <b>$this->total</b> data.";
