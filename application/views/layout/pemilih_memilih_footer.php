<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/vendor/js/sb-admin-2.min.js"></script>
  <script src="<?= base_url() ?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script>
    $('.pilih').on('click', function(e){
    e.preventDefault();
    //console.log('ya');
    const href = $(this).attr('href');
    const name = $(this).attr('data');

    Swal.fire({
      title: name,
      text: 'Apakah Anda Yakin Dengan Pilihan ini?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iya!'
      }).then((result) => {
        if (result.value) {
          $('#modalLoading').modal('show');
          document.location.href = href;
        }
      })
  })

  var mydata;
  var sSuara=[];
  var index = 0;

  window.onload=function(){
    mydata = JSON.parse(atob('<?php echo $data;?>'));
    //console.log(mydata);
  }

  function pilih(el){
    var myArray=el.id.split("_");
    //console.log(myArray[1]);

    Swal.fire({
      title: mydata['calon'][myArray[2]].calon_ketua_nama,
      text: 'Apakah Anda Yakin Dengan Pilihan ini?',
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iya!'
      }).then((result) => {
        if (result.value) {
          // $('#modalLoading').modal('show');
          // document.location.href = href;
          var myChoice = {};
          myChoice['tema_id']= myArray[1];
          myChoice['calon_id'] = myArray[2];

          sSuara.push(myChoice);

          //console.log(sSuara);
          alihHalaman();
        }
      });
  }

  function alihHalaman(){
    var old = index;
    index++;
    if(index < mydata['tema'].length){
      var oldIdTema = 'suratSuara'+mydata['tema'][old].tema_id;
      var newIdTema = 'suratSuara'+mydata['tema'][index].tema_id;

      document.getElementById(oldIdTema).style.display='none';
		  document.getElementById(newIdTema).style.display='block';
    }
    else
    {
      $('#modalLoading').modal('show');
      document.getElementById('idSubmitSuratSuara').value = JSON.stringify(sSuara);
      document.getElementById('myForm').submit();
    }
  }
  </script>
</body>
</html>

<div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PROSES SUBMIT</h5>
        
      </div>
      <div class="modal-body" id="modalBody">
        Mohon tunggu ...
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Petunjuk Pemilihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul>
          <li>Hal. 1. Login pemilih. (Password dikirim dengan SMS)</li>
          <li>Hal. 2  Selamat datang. Surat suara. Masukkan KODE OTP (lihat SMS). Ketik kirim ulang bila belum mendapatkan SMS.</li>
          <li>Hal. 3. Surat Suara. Klik foto untuk memilih.</li>
          <li>Hal. 4. Konfirmasi pilihan. Bila tidak akan kembali ke hal 3.</li>
          <li>Hal. 5. Selesai</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>