<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
<div class="card">
    <div class="card-header">
        <h4>Daftar Pemilih <?= $data_prodi[0]['nama_jenjang'] ?> <?= $data_prodi[0]['nama_prodi'] ?></h4>
    </div>
    <div class="card-body">
        <?php if($user['role_id'] == 1) { ?>
        <!-- <a href="<?= base_url('/Auth_Admin/Pemilih/tambahPemilih') ?>" class="btn btn-sm btn-primary">Tambah Pemilih</a>
        <button class="btn btn-sm btn-warning" onclick="verify_reset()">Reset Pemilih</button>
        <a href="<?= base_url('/Auth_Admin/Pemilih/bulkVerifikasi') ?>" class="btn btn-sm btn-success">Verifikasi Semua</a>   -->
        <?php } else {} ?>
        <!-- <br><br> -->
        <table id="mydat" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Pemilih</th>
                    <th>Angkatan</th>
                    <th>Status Verifikasi</th>
                  
		            <th>monitor</th>	
                    <?php if($user['role_id'] < 3) { ?>
                    <th>Aksi</th>
                    <?php }?>
                    
                </tr>
            </thead>
            <tbody>
                <?php
		$no=1; 
		foreach($pemilih as $p) { 
		
		?>
                    <tr>
			<td><?= $no++ ?></td>
                        <td><?= $p['pemilih_akun'] ?></td>
                        <td><?= $p['pemilih_nama'] ?></td>
                        <td><?= $p['angkatan'] ?></td>
                        <td>
                            <?php
                            if($p['pemilih_verifikasi'] == 0) {
                            ?>
                                <?php if($user['role_id'] == 3) {
                                    echo "Belum Diverifikasi";
                                }  else { ?>
                                <a href="<?= base_url('/Auth_Admin/Pemilih/pemilihVerifikasi/'.$p['pemilih_id']) ?>" class="btn btn-sm btn-primary">Verifikasi</a>
                            <?php
                                } 
                            } else {
                                echo "Sudah Diverifikasi";
                            }
                            ?>
                        </td>
                        
                        <?php
/*
                            if($p['pemilih_status'] == 0) {
                                echo 'Belum memilih';
                            } else {
                               echo "Sudah memilih";
                            }
*/
                            ?>
                       
			            <td><?= $p['pemilih_vote'] ?></td>                    
                        <?php if($user['role_id'] < 3) { ?>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a  href="<?= base_url('/Auth_Admin/Pemilih/ubahPemilih/'.$p['pemilih_id']) ?>" class="dropdown-item btn btn-sm btn-warning" style="color: orange">Ubah</a>
                                    <a  href="<?= base_url('/Auth_Admin/Pemilih/hapusPemilih/'.$p['pemilih_id']) ?>" class="dropdown-item btn btn-sm btn-danger tombol-hapus" style="color: red">Hapus</a>
                                    <!-- <a  href="<?= base_url('/Auth_Admin/Pemilih/pemilihDetail/'.$p['pemilih_id']) ?>" class="dropdown-item btn btn-sm btn-primary" style="color: blue">Detail</a> -->
                                </div>
                            </div>

                            
                        </td>
                        <?php } else {} ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
</div>

<div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
        
      </div>
      <div class="modal-body" id="modalBody">
        Yakin akan reset Pemilih?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="document.getElementById('myForm').submit()">OK!</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
    $attr = array('id'=>'myForm');
    echo form_open(site_url('/Auth_Admin/Pemilih/resetPemilih'), $attr);
?>
</form>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function verify_reset(){
    $('#modalPesan').modal('show');
}
</script>