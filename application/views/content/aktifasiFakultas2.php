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
                        if($fakultas[$i]['status']==1)
                        {
                            echo '<tr>';

                            echo '<td>'.$fakultas[$i]['nama_fakultas'].'</td>';
                            echo '<td style="color:green">Aktif</td>';
                        
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>