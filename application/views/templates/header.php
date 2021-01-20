<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <link rel="icon" href="<?= base_url()?>assets/img/logo.png" type="image/icon type">
  <title><?= $title?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for data tables -->
  <link href="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- modal plugins css -->
  <!-- <link rel="stylesheet" href="<?= base_url()?>assets/css/jquery.modal.min.css"> -->

  <!-- customku -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">
  
    <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url()?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url()?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url()?>assets/js/demo/datatables-demo.js"></script>

  <!-- modal plugin -->
  <!-- <script src="<?= base_url()?>assets/js/jquery.modal.min.js"></script> -->

  <!-- sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>

<body id="body">  
  <!-- modal cetak data login -->
  <div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporanTitle">Download Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font">
              <form action="<?= base_url()?>laporan/cetak_laporan" method="post">
                  <div class="form-group">
                      <label for="jenis_laporan">Jenis Dokumen</label>
                      <select name="jenis_laporan" id="jenis_laporan" class="form-control form-control-sm" required>
                        <option value="">Pilih Jenis Dokumen</option>
                        <option value="Absensi">Absensi Peserta</option>
                        <option value="Laporan">Laporan Peserta</option>
                        <option value="Syahadah">Syahadah Peserta</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="bulan">Bulan</label>
                      <select name="bulan" class="form-control form-control-sm" required>
                          <option value="">Pilih Bulan</option>
                          <option value="1">Januari</option>
                          <option value="2">Februari</option>
                          <option value="3">Maret</option>
                          <option value="4">April</option>
                          <option value="5">Mei</option>
                          <option value="6">Juni</option>
                          <option value="7">Juli</option>
                          <option value="8">Agustus</option>
                          <option value="9">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="tahun">Tahun</label>
                      <select name="tahun" class="form-control form-control-sm" required>
                          <option value="">Pilih Tahun</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="tgl_cetak">Tanggal Cetak Syahadah</label>
                      <input type="date" name="tgl_cetak" id="tgl_cetak" class="form-control form-control-sm" disabled>
                  </div>
                  <div class="d-flex justify-content-end">
                      <input type="submit" value="Cetak Laporan" class="btn btn-sm btn-primary" id="btnlaporan">
                  </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  <!-- modal cetak data login -->

  <!-- Page Wrapper -->
  <div id="wrapper">

  <script>
    $("#btnAddPeserta").click(function(){
      var c = confirm("Yakin akan menambahkan peserta?");
      return c;
    })
    
    $("#btnAddKelas").click(function(){
      var c = confirm("Yakin akan menambahkan kelas?");
      return c;
    })

    $("#jenis_laporan").change(function(){
      let jenis = $(this).val();
      if(jenis == "Syahadah"){
        $("#tgl_cetak").prop('required',true);
        $("#tgl_cetak").prop('disabled',false);
      } else {
        $("#tgl_cetak").prop('required',false);
        $("#tgl_cetak").prop('disabled',true);
      }
    })

  </script>