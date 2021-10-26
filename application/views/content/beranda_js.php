<script>
    $(document).ready(function(){
        setInterval(function(){
            update_data()
        },5000);
    });

    function update_data(){
        url = '<?php echo site_url('Auth_Admin/Beranda/ajax_get_data');?>';
        //console.log(url);

        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status == 200)
            {
                //console.log(this.responseText);
                var data = JSON.parse(this.responseText);
                //console.log(data);

                document.getElementById('dataPemilih').innerHTML = data.pemilih;
                document.getElementById('dataPemilihSuara').innerHTML = data.sdhPilih.hadir;
                document.getElementById('dataPemilihBlmSuara').innerHTML = data.blmPilih.tdkhadir;

                for(var i=0; i<data.tema.length; i++)
                {
                    var id_row = 'masuk'+data.tema[i].tema_id;
                    document.getElementById(id_row).innerHTML = data.tema[i].jumlah;
                }
                
                                
            }
        }

        xhttp.open("GET", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
        
    }
</script>