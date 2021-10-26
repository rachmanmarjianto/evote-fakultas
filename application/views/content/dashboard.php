<meta http-equiv="refresh" content="2">
<div class="container mt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-gray-800">A. Data</h5>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemilih</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jlhPemilih ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach($jenis as $j) { ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $j['tema_nama'] ?></div>
                                <?php 
                                $hasil = $this->db->query("SELECT COUNT(calon_ketua_id) AS hasil FROM tb_calon_ketua WHERE tema_id=".$j['tema_id'])->row_array(); ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hasil['hasil'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-gray-800">B. Pemilih</h5>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemilih Hadir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hadir['hadir'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pemilih Belum Hadir</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tdkhadir['tdkhadir'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-gray-800">C. Perhitungan Suara Masuk</h5>
    </div>

    <div class="row">
        <?php foreach($jenis as $j) { ?>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $j['tema_nama'] ?></div>
                                <?php 
                                $hasil = $this->db->query("SELECT SUM(calon_ketua_suara) AS suara FROM tb_calon_ketua WHERE tema_id=".$j['tema_id'])->row_array(); ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $hasil['suara'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>