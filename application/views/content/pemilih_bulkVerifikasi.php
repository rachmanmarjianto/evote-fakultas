<div class="card">
    <div class="card-header">
        <h4>Daftar Pemilih</h4>
    </div>
    <div class="card-body">
        <?php if($user['role_id'] == 1) { ?>
        <div class="row">
            <button class="btn btn-sm btn-success col-lg-3 col-md-3" onclick="proses_verifikasi()">Proses Verifikasi</button>
            <div id="pesan" class="col-lg-9 col-md-9"></div>
        </div>
        <?php } else {} ?>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor HP</th>
                    <th>Nama Pemilih</th>
                    <th>Utusan</th>
                    <th>Status Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pemilih as $p) { ?>
                    <tr>
                        <td><?= $p['pemilih_contact'] ?></td>
                        <td><?= $p['pemilih_nama'] ?></td>
                        <td><?= $p['pemilih_utusan'] ?></td>
                        <td id="status<?php echo $p['pemilih_id'];?>">
                            <?php
                            if($p['pemilih_verifikasi'] == 0) {
                            ?>
                                <?php if($user['role_id'] == 3) {
                                    echo "Belum Diverifikasi";
                                }  else { ?>
                                <b style="color:red">Belum Terverifikasi</b>
                            <?php
                                } 
                            } else {
                                echo '<b style="color:green">Terverifikasi</b>';
                            }
                            ?>
                        </td>
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
      <div class="modal-body" >
        Jalankan proses Verifikasi?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="jalanVerif()">OK!</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBerhasil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PROSES VERIFIKASI SELESAI</h5>
        
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

<?php
    $attr = array('id'=>'myForm');
    echo form_open(site_url('/Auth_Admin/Pemilih/bulkVerifikasi'), $attr);
?>
</form>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var json_dat = '<?php echo $json;?>';
    var json_parse;
    var i;
    var coba;

    window.onload=function(){
        json_parse=JSON.parse(json_dat);
        i=parseInt(0);
        coba=parseInt(0);
        console.log(json_parse);
    }

    function proses_verifikasi(){
        $('#modalPesan').modal('show');
    }

    function jalanVerif(){
        $('#modalPesan').modal('hide');
        verifikasi(0);
        
    }

    function verifikasi(index){
        
        var id = json_parse[index].pemilih_id;
        var hp = json_parse[index].pemilih_contact;

        if(json_parse[index].pemilih_verifikasi==1)
        {
            document.getElementById('pesan').innerHTML = 'no '+hp+' telah Diverifikasi';
            index++;

            if(index < json_parse.length)
                verifikasi(index);
            else
            {
                document.getElementById('pesan').innerHTML = 'Verifikasi sebanyak '+index+' nomor Berhasil!!';
                document.getElementById('modalBody').innerHTML = 'Verifikasi sebanyak '+index+' nomor Berhasil!!';
                $('#modalBerhasil').modal('show');
            }
        }
        else
        {
            document.getElementById('pesan').innerHTML = 'Proses Verifikasi no '+hp+' ...';

            url = '<?php echo site_url();?>/Auth_Admin/Pemilih/ajax_verifikasi';

            var xhttp = new XMLHttpRequest();
            
            xhttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status == 200)
                {
                    if(this.responseText==0)
                    {  
                        document.getElementById('pesan').innerHTML = 'SUKSES Verifikasi no '+hp;
                        index++;
                        coba=0;
                        if(index < json_parse.length)
                        {
                            var idEl = 'status'+id;
                            document.getElementById(idEl).innerHTML = '<b style="color:green">Terverifikasi</b>';
                            verifikasi(index);
                        }                            
                        else
                        {
                            var idEl = 'status'+id;
                            document.getElementById('pesan').innerHTML = 'Verifikasi sebanyak '+index+' nomor Berhasil!!';
                            document.getElementById(idEl).innerHTML = '<b style="color:green">Terverifikasi</b>'
                            document.getElementById('modalBody').innerHTML = 'Verifikasi sebanyak '+index+' nomor Berhasil!!';
                            $('#modalBerhasil').modal('show');

                        }
                        
                    }
                    else
                    {
                        document.getElementById('pesan').innerHTML = 'COBA ULANG Verifikasi no '+hp;
                        coba++;
                        if(coba<3){
                            verifikasi(index);
                        }
                        else
                        {
                            document.getElementById('pesan').innerHTML = '3 kali GAGAL mencoba Verifikasi no '+hp+', Proses Dihentikan!!';
                            document.getElementById('modalBody').innerHTML = "3 kali GAGAL mencoba Verifikasi no '+hp+', Proses Dihentikan!!\nSilahkan klik Button 'Proses Verifikasi' lagi untuk meneruskan Proses!";
                            $('#modalBerhasil').modal('show');
                        }
                    }
                    
                }
            }
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id="+id+"&hp="+hp);

        }

        
    }
</script>