<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
<div class="card">
    <div class="card-header">
        <h4>Daftar Pemilih per Prodi</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Program Studi</th>
                    <th>Jumlah Pemilih</th>
                    <?php
                        if($user['role_id']<3)
                        {
                    ?>
                    <th>Aksi</th>
                    <?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $no=1; 
                foreach($pemilih as $p) { 
                    echo '
                        <tr>
                            <td><a href="'.site_url('Auth_Admin/Pemilih/detail_prodi/'.$p['id_program_studi']).'">'.$p['nama_jenjang'].' '.$p['nama_prodi'].'</a></td>
                            <td id="row_'.$p['id_program_studi'].'">'.$p['jumlah'].'</td>';
                    if($user['role_id']<3){
                        echo '<td><a href="'.site_url('Auth_Admin/Cetak/unduh_pemilih/'.$p['id_program_studi']).'" target="_blank"><button type="button" class="btn btn-success btn-sm">Unduh Data</button></a></td>';
                    }
                    echo '</tr>';


                }
            ?>

            </tbody>
        </table>
    </div>
</div>