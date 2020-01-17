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
<h2>Laporan Pengajuan Diterima</h2>
<div class="alert alert-info">
    Pilih tanggal Awal Penerimaan dan Akhir Penerimaan
</div>

<form class="form-inline" method="post" action="<?php echo URL; ?>laporan/terimaAll">
    <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
        <input class="form-control" type="text" name="tgl_awal" value="" placeholder="Mulai Tanggal" readonly>
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    </div> s/d
    <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
        <input class="form-control" type="text" name="tgl_akhir" value="" placeholder="Sampai Tanggal" readonly>
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    </div> 
    <input type="submit" class="btn btn-primary" value="Buat Laporan">
</form>
