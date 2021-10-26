<div class="container">
    <h4 class="text-center mt-4 text-dark">Selamat Datang <?= $usernama ?> <br> Silahkan Lakukan Pemilihan</h4>
    <div class="row justify-content-center mt-1">
        
        <?php //foreach($tema as $t) { ?>
        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
            <div class="card o-hidden border-1 shadow-lg my-4">
                <div class="card-body text-center 
                    <?php 
                        // $nilai = $t['tema_id'];
                        $nilai = 3;
                        echo $nilai % 2 ? 'bg-dark text-white' : 'text-dark';
                    ?>
                ">
                    <h4 class="card-title">Surat Suara<br></h4>
                    <hr>
                    <img src="<?= base_url('/assets/img/hero-img.png') ?>" alt="" class="img-thumbnail" width="150">
                    <?php
                    $query = $this->db->get_where('tb_suara', ['nim' => $user]);
                    $cek = $query->num_rows();
                    if($cek > 0) {
                        echo "<br>Sudah Memilih";
                    } else {
                    ?>
                    <hr>
            
                    <div class="form-group">
                        <label for="">Masukan Kode OTP sesuai SMS:</label>
                        <input id="idotp" type="text" class="form-control" Placeholder="Masukan 5 Digit OTP" onkeyup="submit()">
                    </div>
            

            <!--        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input class="m-2 text-center form-control rounded" type="text" id="first" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="second" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="third" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="fourth" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="text" id="fifth" maxlength="1" /> </div>-->
                    <div id="warning"></div>
                    <div id="ulangOTP">

                    </div>
                    
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php //} ?>
    </div>
    <?php if($hasilCount == $countTema) { ?>
        <div class="text-center">
            <a href="<?= base_url('PemilihAuth/logout') ?>" class="btn btn-lg btn-success">Selesai</a>
        </div>
    <?php } ?>
    
    
</div>

<?php
    $attr=array("id"=>"formSubmit");
    echo form_open(site_url('PemilihAuth/pemilihMemilih/'), $attr);
?>
</form>

<div id="alert">
</div>


<?php 
    $attr=array("id" => "myForm");
    echo form_open(site_url('PemilihAuth/verifOTP'), $attr);
?>
    <input id="hiddenOTP" type="hidden" name="otp">
</form>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">PERHATIAN !!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>OTP dikirim ke nomor <span style="color:red"><?= $phone ?></span>. Jika nomor salah, silahkan ubah pada akun Cybercampus anda dan login kembali!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

document.addEventListener("DOMContentLoaded", function(event) {

    function OTPInput() {
        const inputs = document.querySelectorAll('#otp > *[id]');
        for (let i = 0; i < inputs.length; i++) { 
            inputs[i].addEventListener('keydown', function(event) { 
                if (event.key==="Backspace" ) { 
                    inputs[i].value='' ; 
                    if (i !==0) 
                        inputs[i - 1].focus(); 
                } 
                else { 
                    if (i===inputs.length - 1 && inputs[i].value !=='' ) { 
                        return true; 
                    } 
                    else if (event.keyCode> 47 && event.keyCode < 58) { 
                        inputs[i].value=event.key; 
                        if (i !==inputs.length - 1) 
                            inputs[i + 1].focus(); 
                        else{
                            var o='';
                            for(x=0;x<=i;x++)
                                o+=inputs[x].value;
                            //document.getElementById('hiddenOTP').value = o;
                            //document.getElementById('myForm').submit();
                            checkOTP(o);
                        }


                        event.preventDefault(); 
                    } 
                    else if (event.keyCode> 64 && event.keyCode < 91) { 
                        inputs[i].value=String.fromCharCode(event.keyCode); 
                        if (i !==inputs.length - 1) 
                            inputs[i + 1].focus(); 
                        else{
                        
                            var o='';
                            for(x=0;x<=i;x++)
                                o+=inputs[x].value;
                            //document.getElementById('hiddenOTP').value = o;
                            //document.getElementById('myForm').submit();
                            checkOTP(o);
                        }
                            
                        event.preventDefault(); 
                    } 
                } 
            }); 
        } 
    } 
    OTPInput(); 
});

var coba=0;

window.onload=function(){
    kirimUlangOTP();
    $('#myModal').modal('show');
}

function submit(event){
    var otp = document.getElementById('idotp').value;

    if(otp.length >= 5)
    {
        //document.getElementById('hiddenOTP').value = otp;
        //document.getElementById('myForm').submit();
        checkOTP(otp);

    }

}

function kirimUlangOTP()
{
    var time = 30;
    if(coba>0)
    {
        time = 60 * 1;
    }
    startTimer(time);

    coba++;
}

function startTimer(duration) {
    var timer = duration, minutes, seconds;
    var mytimer = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById('ulangOTP').innerHTML = "Kirim Ulang OTP: " + minutes + ":" + seconds;
        //console.log("Kirim Ulang OTP: " + minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
            clearInterval(mytimer);
            document.getElementById('ulangOTP').innerHTML = "<button class=\"btn btn-md btn-primary\" onclick=\"resendOTP()\">Kirim Ulang OTP</button>";
        }
    }, 1000);
}

function resendOTP(){
    url = '<?php echo site_url();?>/PemilihAuth/ajax_kirim_otp';

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status == 200)
        {
            //console.log(this.responseText);
            //dataTransaksi = this.responseText;
            //var data = JSON.parse(this.responseText);
            if(this.responseText==0)
            {
                kirimUlangOTP();

                document.getElementById("alert").innerHTML = '\
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">\
                    OTP berhasil dikirim!\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                        <span aria-hidden="true">&times;</span>\
                    </button>\
                </div>';

            }
            else
            {
                document.getElementById("alert").innerHTML = '\
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">\
                    OTP gagal dikirim, Coba sekali lagi!\
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                        <span aria-hidden="true">&times;</span>\
                    </button>\
                </div>';
            }
            
        }
    }
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function checkOTP(otp)
{
    url = '<?php echo site_url();?>/PemilihAuth/verifOTP';

    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function(){
        if(this.readyState==4 && this.status == 200)
        {
            //console.log(this.responseText);
            if(this.responseText==0)
            {
                document.getElementById('warning').innerHTML='';
                document.getElementById('formSubmit').submit()
            }
            else
            {
                document.getElementById('warning').innerHTML='<p style="color:red">Kode OTP Tidak sesuai!</p>';
            }

        }
    }
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("otp="+otp);
}
</script>