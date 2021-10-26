<?php 
$i=0;
foreach($calon as $c) { 
    if($i==0)
        echo '<div class="container" id="suratSuara'.$c['tema_id'].'" style="display:block">';
    else
        echo '<div class="container" id="suratSuara'.$c['tema_id'].'" style="display:none">';
?>
    <h4 class="text-center mt-4 text-dark">Surat Suara <?= $c['tema_nama'] ?></h4>
    <div class="row justify-content-center mt-1">
    <?php
        foreach($c['calon'] as $ss) {
    ?>        
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="card o-hidden border-0 shadow-sm my-5">
                <div class="card-body text-center" style="cursor:pointer" onclick="pilih(this)" id="SS_<?= $c['tema_id']?>_<?= $ss['calon_ketua_id']?>">
                    <h4 class="card-title"><?= $ss['calon_ketua_nourut'] ?></h4>
                    <img src="<?= base_url('/assets/img/'.$ss['calon_ketua_foto']) ?>" alt=""  width="200" height="200" >
                    <hr>
                    <h4 class="card-title"><?= $ss['calon_ketua_nama'] ?></h4>
                </div>
            </div>
        </div>
    <?php 
        }
    ?>        
    </div>
</div>
<?php 
$i++;
} 
?>
<?php 
$attr = array("id"=>"myForm");
echo form_open('/PemilihAuth/mySuara', $attr); ?>
<input type="hidden" name="suratSuara" id="idSubmitSuratSuara">
</form>