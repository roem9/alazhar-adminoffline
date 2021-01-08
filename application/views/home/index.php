<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $header?></h1>
        </div>

        <div class="row fo-13">
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <div class="row">
                            <div class="col-6">Gender</div>
                            <div class="col-6"><i class="fa fa-male"></i> <i class="fa fa-female"></i> </div>
                        </div>
                    </li>
                    <li class="list-group-item"><i class="fa fa-male"></i> Ikhwan</li>
                    <li class="list-group-item"><i class="fa fa-female"></i> Akhwat</li>
                </ul>
            </div>
            
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <div class="row">
                            <div class="col-6">Pendidikan</div>
                            <div class="col-6"><i class="fa fa-book"></i></div>
                        </div>
                    </li>
                    <li class="list-group-item">SD/Sederajat</li>
                    <li class="list-group-item">SMP/Sederajat</li>
                    <li class="list-group-item">SMA/Sederajat</li>
                    <li class="list-group-item">Diploma I/II/III</li>
                    <li class="list-group-item">S1/S2/S3</li>
                </ul>
            </div>
            
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <div class="row">
                            <div class="col-6">Pekerjaan</div>
                            <div class="col-6"><i class="fa fa-book"></i></div>
                        </div>
                    </li>
                    <li class="list-group-item">Pelajar</li>
                    <li class="list-group-item">Mahasiswa</li>
                    <li class="list-group-item">Swasta</li>
                    <li class="list-group-item">PNS/BUMN</li>
                    <li class="list-group-item">TNI/POLRI</li>
                    <li class="list-group-item">Lainnya</li>
                </ul>
            </div>

            <div class="col-3"> 
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <div class="row">
                            <div class="col-6">Pendaftar</div>
                            <div class="col-6"><i class="fa fa-book"></i></div>
                        </div>
                    </li>
                    <li class="list-group-item">Kelompok</li>
                    <li class="list-group-item">Peserta</li>
                </ul>
            </div>
            
            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-info">
                        <div class="row">
                            <div class="col-6">Program</div>
                            <div class="col-6"><i class="fa fa-book"></i></div>
                        </div>
                    </li>
                    <!-- <?php foreach ($program as $program):?>
                        <li class="list-group-item"><?=$program['program']?> <?= $program['peserta']?></li>
                    <?php endforeach;?> -->
                </ul>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</div>

<script>
    $("#home").addClass("active")
</script>