<?php

/* 
 * Go Software Media Project.
 * www.gosoftware.web.id
 * http://phpbego.wordpress.com.
 */

$this->renderFeedbackMessages(); 
?>
<h2>Proses Pembimbing</h2>
<?php if ($this->pmmb) { ?>
<form class="form-horizontal" data-toggle="validator" role="form" method="post" action="<?php echo URL; ?>pembimbing/saveEdit/<?php echo $this->pmmb->aju_id; ?>">
    <div class="form-group">
        <label class="col-md-2 control-label">Pembimbing 1</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="pmmb1" value="<?php echo htmlentities($this->pmmb->aju_pmmb1); ?>" placeholder="Pembimbing 1" required="">
        </div>
    </div>  
     <div class="form-group">
        <label class="col-md-2 control-label">Pembimbing 2</label>
        <div class="col-md-10">
            <input type="text" class="form-control" name="pmmb2" value="<?php echo htmlentities($this->pmmb->aju_pmmb2); ?>" placeholder="Pembimbing 2" required="">
        </div>
    </div> 
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-primary" name="prcnew" value="Simpan" />
            <a class="btn btn-primary" href="<?php echo URL; ?>pembimbing">Kembali</a>
        </div>
    </div>
</form>
<?php } else { ?>
    <p>Data tidak ditemukan ! </p>
    <?php
}