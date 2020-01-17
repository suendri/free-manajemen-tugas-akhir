<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $("#user_nim").keyup(function () {
            $('#pesan').html("<img src='../public/images/loading.gif'>");
            var user_nim = $("#user_nim").val();

            $.ajax({
                type: "POST",
                url: "<?php echo URL; ?>index/getNim",
                data: "user_nim=" + user_nim,
                cache: false,
                success: function (data) {
                    if (data == 0) {
                        $("#pesan").html("NIM Tidak Tersedia");
                        $('#user_nim').css('border', '1px #C33 solid');
                        $("#password").attr("disabled", "disabled");
                        $("#email").attr("disabled", "disabled");
                        $("#nama").attr("disabled", "disabled");
                        $("#daftar").attr("disabled", "disabled");                        
                    }
                    else {
                        $("#pesan").html("NIM Tersedia");
                        $('#user_nim').css('border', '1px #090 solid');
                        $("#password").removeAttr("disabled");
                        $("#email").removeAttr("disabled");
                        $("#nama").removeAttr("disabled");
                        $("#daftar").removeAttr("disabled");
                    }
                }
            });
        });
    });
</script>

<div class="row">
    <div class="col-md-4">
        <div class="isi">
            <form class="login" data-toggle="validator" role="form" method="POST" action="<?php echo URL; ?>index/saveAdd">
                <h4>Registrasi Akun Baru</h4>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" class="form-control" name="user_nim" id="user_nim" placeholder="NIM" required="" autocomplete="off" maxlength="8">
                    <p class="help-block"><span id="pesan"></span></p>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="user_password" maxlength="20" id="password" placeholder="Password" required="" autocomplete="off">
                    <p class="help-block">Minimal 4 karakter dan Maksimal 20 karakter.</p>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="user_email" id="email" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="user_nama" id="nama" placeholder="Nama Lengkap" required="" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" id="daftar" value="Daftar">
                    <a href="<?php echo URL; ?>" class="btn btn-danger">Batal</a>
                </div>

                <?php $this->renderFeedbackMessages(); ?>
            </form>    
        </div>
    </div>
</div>