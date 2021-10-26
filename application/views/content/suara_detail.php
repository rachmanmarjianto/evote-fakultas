
<div class="card mb-5">
    
    <div class="card-header">
	<h4>Hasil</h4>
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Jumlah Suara Masuk</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Hasil Suara Pemilihan</a>
            </li> -->
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- <a href="<?= base_url('Auth_Admin/Cetak/cetakPemilih/') ?>" class="btn btn-sm btn-success"  target="__blank">Cetak Daftar Pemilih</a> -->
                <a href="<?= base_url('Auth_Admin/Cetak/cetakSuara/') ?>" class="btn btn-sm btn-success" target="__blank">Cetak Hasil Pemilihan</a>
                <br>
                <br>
                <h3 class="text-center mt-4">Jumlah Suara Masuk</h3>
				<?php 
                //$hasil = $this->db->query("SELECT count(nim) AS suara FROM tb_suara")->row_array(); ?>
				
                <h1 class="text-center mt-5 display-1" id="jumlPemilih">0</h1>
                <!-- <div id="piechart" width="400"></div></h1> -->
                <h3>Hasil Akhir</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <!--<th>Foto Calon</th>-->
                            <th>Tema</th>
                            <th>Prodi</th>
                            <th>No Urut</th>
                            <th>Calon</th>
                            <th>Suara</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($gabung as $s) { ?>
                            <?php foreach($s['calon'] as $calon) {?>
                                <tr>
                                    <td><?= $s['tema_nama'] ?></td>
                                    <td><?= $calon['prodi'] ?></td>
                                    <td><?= $calon['calon_ketua_nourut'] ?></td>
                                    <td><?= $calon['calon_ketua_nama'] ?></td>
                                    <td id="urutan_row_<?= $calon['calon_ketua_id'];?>"><?= $calon['calon_ketua_suara'] ?></td>
                                </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </table>
                
            </div>
            
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var total_pemilih = "<?php echo $jumlah_verifikasi;?>";
    

    $(document).ready(function(){
        setInterval(function(){
            update_data()
        },2000);
    });

    function update_data()
    {
        url = '<?php echo site_url('Auth_Admin/Suara/ajax_get_suara');?>';
        //console.log(url);

        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status == 200)
            {
                //console.log(this.responseText);
                var json = JSON.parse(this.responseText);           
                
                if(json.suara.length != 0)
                {
                    for(var i=0; i<json.suara.length; i++){
                        var id_row = 'urutan_row_'+json.suara[i].calon_ketua_id;
                        document.getElementById(id_row).innerHTML = json.suara[i].calon_ketua_suara;
                    }

                    document.getElementById('jumlPemilih').innerHTML = json.pemilih;
                }
                
            }
        }

        xhttp.open("GET", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    }
    
  

</script>