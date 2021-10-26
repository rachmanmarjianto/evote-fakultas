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
    console.log('ya');
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
          document.location.href = href;
        }
      })
  })
  </script>
</body>
</html>


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
          <li>Pilih salah satu jenis pemilihan dengan mengklik tombol pilih.</li>
          <li>Setelah anda mengklik tombol pilih maka akan masuk kehalaman pemilihan calon yang menampilkan foto dan nama calon.</li>
          <li>Klik salah satu foto calon untuk melakukan pemilihan dan anda kembali dibawa kehalaman jenis pemilihan.</li>
          <li>Apabila anda sudah menyelesaikan pemilihan maka akan muncul tombol selesai</li>
          <li>Klik tombol selesai jika anda telah selesai memilih</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>