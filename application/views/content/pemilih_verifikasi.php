<div class="card">
    <div class="card-header">
        <h3>Verifikasi Pemilih</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
            <?php if($pemilih['pemilih_foto'] == '' || $pemilih['pemilih_foto'] == null)
                {
            ?>
                    <img src="<?php echo base_url('assets/icon/index.png')?>" class="img-thumbnail rounded-circle mb-2" width="200" alt="">
            <?php
                }
                else
                {
            ?>
                    <img src="<?= base_url('assets/img/img-pemilih/'.$pemilih['pemilih_foto']) ?>" class="img-thumbnail rounded-circle mb-2" width="200" alt="">
            <?php
                }
            ?>
            </div>
			<div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Nomor Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_akun'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Nama Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_nama'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Email</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_email'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Contact</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_contact'] ?></label>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar Depan</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_depan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar S3</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_s3'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar Belakang</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_belakang'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_jk'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">NIDN/NDIK/NUPN</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_nidn'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Pendidikan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_pend_akhir'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Golongan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_golongan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Jabatan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_jabatan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Program Studi</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-5">
                        <label for=""><?= $pemilih['pemilih_prodi'] ?></label>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Utusan</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-5">
                        <label for=""><?= $pemilih['pemilih_utusan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Status Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for="">
                            <?php
                            if($pemilih['pemilih_status'] == 0) {
                                echo 'Belum memilih';
                            } else {
                                echo "Sudah memilih";
                            }
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="idPemilih" value="<?php echo $pemilih['pemilih_id'];?>">
        <input type="hidden" id="idContact" value="<?php echo $pemilih['pemilih_contact'];?>">

        <?php
            $attr = array('id'=>'myForm');
            echo form_open(site_url('/Auth_Admin/Pemilih'), $attr);
        ?>
        </form>
        
        
        <?php
        if($pemilih['pemilih_verifikasi'] == 0) {
        ?>
            <!--<a href="<?= base_url('/Auth_Admin/Pemilih/verifikasi/'.$pemilih['pemilih_id']) ?>" class="btn btn-sm btn-primary">Verifikasi</a>-->
            <button id="idVerifikasi" class="btn btn-sm btn-primary" onclick="verifikasi()">Verifikasi</a>
        <?php
        } else {
            echo "Sudah Diverifikasi";
        }
        ?>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        
      </div>
      <div class="modal-body">
        Proses Kirim SMS ...
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        
      </div>
      <div class="modal-body" id="modalBody">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="document.getElementById('myForm').submit()">OK!</button>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

function verifikasi(){

    $('#loadingModal').modal('show');

    var id =  document.getElementById('idPemilih').value;
    var hp =  document.getElementById('idContact').value;

    url = '<?php echo site_url();?>/Auth_Admin/Pemilih/ajax_verifikasi';

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status == 200)
        {
            //console.log(this.responseText);
            //dataTransaksi = this.responseText;
            //var data = JSON.parse(this.responseText);
            if(this.responseText==0)
            {
                $('#loadingModal').modal('toggle');        

                $pesan = "SMS Verifikasi Berhasil dikirim!";

                document.getElementById('modalBody').innerHTML = $pesan;

                $('#modalPesan').modal('show');
                setTimeout(function(){
                    document.getElementById('myForm').submit();
                }, 1000);
            }
            else
            {
                var json = JSON.parse(this.responseText);
                $('#loadingModal').modal('toggle');        

                $pesan = json.status+' : '+json.pesan;

                document.getElementById('modalBody').innerHTML = $pesan;

                $('#modalPesan').modal('show');
                setTimeout(function(){
                    document.getElementById('myForm').submit();
                }, 1000);

            }
            
        }
    }
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&hp="+hp);


}

</script>