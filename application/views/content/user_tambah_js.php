<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var fakultas;

    window.onload = function(){
        fakultas = JSON.parse('<?php echo json_encode($fakultas);?>');
        //console.log(fakultas);
    }

    function get_user(){

        var nim = document.getElementById('idNIMgetUser').value;
        var el = document.getElementById('idRoleGetUser');
        var role = el.options[el.selectedIndex].value;

        var namaEl = document.getElementById('idNama');
        var nimEl = document.getElementById('idNIM');

        if(nim.length >= 12)
        {
            var loader = document.getElementById('loader');
            loader.innerHTML = '<div class="spinner-border" role="status"></div>';
            namaEl.value="";
            nimEl.value="";
            url = '<?php echo site_url();?>Auth_Admin/UserAuth/getUserFromCyber';
 
            var xhttp = new XMLHttpRequest();
            
            xhttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status == 200)
                {
                    if(this.responseText != 0)
                    {
                        var mydata = JSON.parse(this.responseText);
                        //console.log(mydata);

                        var nimVal;
                        if(mydata.items[0].pengguna.JOIN_TABLE==2){
                            nimVal = mydata.items[0].nip_dosen;
                        }
                        else if(mydata.items[0].pengguna.JOIN_TABLE==3){
                            nimVal = mydata.items[0].NIM_MHS;
                        }
                        else{
                            nimVal = mydata.items[0].nip_pegawai;
                        }

                        namaEl.value=mydata.items[0].pengguna.NM_PENGGUNA;
                        
                        nimEl.value=nimVal;
                    }
                    else
                    {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Pengguna Tidak Ditemukan!'
                        })
                    }
                    
                    loader.innerHTML ='';
                }
            }
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("nim="+nim+"&role="+role+"&fakultas="+fakultas[0].id_fakultas);

        }

        
    }
</script>