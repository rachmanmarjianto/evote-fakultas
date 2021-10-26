<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />
<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <h4>Aktifasi Fakultas</h4>
    </div>
    <div class="card-body">
        <table id="mydat" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Fakultas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i=0; $i<count($fakultas); $i++)
                    {
                        echo '<tr>';

                        echo '<td>'.$fakultas[$i]['nama_fakultas'].'</td>';
                        $status = $fakultas[$i]['status'];
                        $id = $fakultas[$i]['id_fakultas'];
                        if($status == 0)
                            echo '<td><a href="'.site_url('/Auth_Admin/AktifasiFakultas/aktifasi/'.$id.'/'.$status).'"><button type="button" class="btn btn-danger">Non-Aktif</td></a>';
                        else
                            echo '<td><a href="'.site_url('/Auth_Admin/AktifasiFakultas/aktifasi/'.$id.'/'.$status).'"><button type="button" class="btn btn-success">Aktif</td></a>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>