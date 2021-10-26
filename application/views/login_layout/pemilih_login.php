<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?= base_url() ?>/assets/icon/vote-yea-solid.svg"  type="image/svg+xml" sizes="any">

  <title>E-Voting - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url() ?>assets/vendor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>assets/vendor/css/sb-admin-2.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
       $(document).ready(function(){
           $('.captcha-refresh').on('click', function(){
               $.get('<?php echo base_url().'PemilihAuth/refresh'; ?>', function(data){
                   $('#image_captcha').html(data);
               });
           });
       });
   </script>

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <img src="<?= base_url() ?>assets/icon/logo_pemira.png" alt="" class="img-responsive rotate-n-0" width="150">
                    
					<h1 class="h4 text-gray-900 mb-4 mt-4">PEMIRA Fakultas <?= $fakultas; ?></h1>
          <h1 class="h5 text-gray-900 mb-4 mt-4">Login Pemilih</h1>
                    <?= $this->session->flashdata('message'); ?>
                  </div>
                  <?php
                    $attr = array('class' => 'user mt-5');
                    echo form_open('PemilihAuth', $attr);
                  ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="nopemilih" placeholder="NIM" id="idUname">
                      <?= form_error("nopemilih", '<small class="text-danger">', '</small>')?>
                    </div>
					          <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="passwd" placeholder="Password">
                      <?= form_error("nopemilih", '<small class="text-danger">', '</small>')?>
                    </div>

                    <span id="image_captcha"><?php echo $captchaImg; ?></span>
                    <a href="javascript:void(0);" class="captcha-refresh btn btn-success btn-sm" >Refresh!</a>

                    <div class="form-group" style="padding-top:10px">
                      <input type="text" class="form-control form-control-user" name="capt" placeholder="Inputkan Captcha..." autocomplete="off">
                      <?= form_error("capt", '<small class="text-danger">', '</small>')?>
                    </div>

                    <input type="submit" class="btn btn-primary btn-user btn-block" name="login-pemilih" value="Login">
                  <?= form_close() ?>
                  <span class="flash-data" data-flashdata="<?= $this->session->flashdata('berhasil') ?>"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/vendor/js/sb-admin-2.min.js"></script>
  <script src="<?= base_url() ?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script>
    const flashData = $('.flash-data').data('flashdata');

    window.onload=function(){
      document.getElementById('idUname').focus();
    }

    // console.log(flashData);
    if(flashData) {
      Swal.fire(
        'Berhasil!',
        flashData,
        'success'
      )
    }
  </script>
</body>

</html>
