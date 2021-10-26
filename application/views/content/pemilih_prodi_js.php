
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    
    // var id_fakultas = ;

    $(document).ready(function() {
        $('#mydat').DataTable({
            "order": [[ 1, "asc" ]]
        });

        setInterval(function(){
            update_data()
        },2000);

        //console.log(document.getElementById('row_243').innerHTML);
    } );

    function update_data(){
        url = '<?php echo site_url('Auth_Admin/Pemilih/ajax_get_suara_prodi/'.$id_fakultas);?>';
        //console.log(url);

        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status == 200)
            {
                //console.log(this.responseText);
                var json = JSON.parse(this.responseText);  
                
                for(var i=0; i<json.length; i++)
                {
                    var id_row = 'row_'+json[i].id_program_studi;
                    document.getElementById(id_row).innerHTML = json[i].jumlah;
                    //console.log(document.getElementById(id_row).innerHTML);
                }
            
            }
        }

        xhttp.open("GET", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhttp.send('id_fakultas='+id_fakultass);
        xhttp.send();
    }
</script>