<script>
    var prodi;
    var tema;

    window.onload=function(){
        var prodi_tmp = '<?php echo json_encode($prodi);?>';
        prodi = JSON.parse(prodi_tmp);
        //console.log(prodi);

        var tema_tmp = '<?php echo json_encode($tema);?>';
        tema = JSON.parse(tema_tmp);
        //console.log(tema);
    }

    function idJenisPemilihan(el){
        var val = el.options[el.selectedIndex].value;

        var temaID=0;
        for(var i=0; i<tema.length; i++){
            if(val == tema[i].tema_id)
            {
                if(tema[i].prodi == 1)
                {
                    document.getElementById('idSelectProdi').disabled = false;
                    
                }
                else
                {
                    var elProd = document.getElementById('idSelectProdi');
                    elProd.value=0;
                    elProd.disabled = true;
                    
                }
            }
        }
        //console.log(val);
    }
</script>