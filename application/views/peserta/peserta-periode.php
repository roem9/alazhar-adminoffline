<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <?php if($konfirm == 1) :?>
                    <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Peserta</a>
                <?php endif;?>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="msgPeserta">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" style="max-width: 1200px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <?php if($konfirm == 1):?>
                                    <tr>
                                        <th width="3%">No</th>
                                        <th width="8%">Tgl Daftar</th>
                                        <th width="7%"><center>ID</center></th>
                                        <th width="">Nama</th>
                                        <th width="5%"><center>WA</center></th>
                                        <th width="6%"><center>Pembayaran</center></th>
                                        <th width="12%"><center>Checklist</center></th>
                                        <th width="6%">Kelas</th>
                                        <th width=5%><center>Wl</center></th>
                                        <th width=5%>Detail</th>
                                        <th width=5%><center>Salin</center></th>
                                    </tr>
                                <?php else :?>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Tgl Daftar</th>
                                        <th width="">Nama</th>
                                        <th width=7%>Konfirmasi</th>
                                    </tr>
                                <?php endif;?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal peserta -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalDetail">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link active' id="btn-form-1"><i class="fas fa-user"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-3">Tambah Kelas/WL</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="card" id="form-1">
                            <div class="card-header text-primary">
                                <strong>Data Diri</strong>
                            </div>
                            <div class="card-body">
                                <div class="msgEditPeserta"></div>
                                <form id="formEditPeserta">
                                    <input type="hidden" name="id_peserta">
                                    <div class="form-group">
                                        <label for="tgl_daftar">Tgl Daftar</label>
                                        <input type="text" name="tgl_daftar" id="tgl_daftar_edit" class="form-control form-control-sm" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_peserta">ID Peserta</label>
                                        <input type="text" name="no_peserta" id="no_peserta_edit" class="form-control form-control-sm" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_indo">Nama Lengkap (Indonesia)</label>
                                        <input type="text" name="nama_indo" id="nama_indo_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_arab">Nama Lengkap (Arab)</label>
                                        <input type="text" name="nama_arab" id="nama_arab_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="t4_lahir_indo">Tempat Lahir (Indonesia)</label>
                                        <input type="text" name="t4_lahir_indo" id="t4_lahir_indo_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="t4_lahir_arab">Tempat Lahir (Arab)</label>
                                        <input type="text" name="t4_lahir_arab" id="t4_lahir_arab_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tgl Lahir</label>
                                        <input type="date" name="tgl_lahir" id="tgl_lahir_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select name="jk" id="jk_edit" class="form-control form-control-sm">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desa_kel_indo">Desa / Kelurahan (Indonesia)</label>
                                        <input type="text" name="desa_kel_indo" id="desa_kel_indo_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="desa_kel_arab">Desa / Kelurahan (Arab)</label>
                                        <input type="text" name="desa_kel_arab" id="desa_kel_arab_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="kec_indo">Kecamatan (Indonesia)</label>
                                        <input type="text" name="kec_indo" id="kec_indo_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kec_arab">Kecamatan (Arab)</label>
                                        <input type="text" name="kec_arab" id="kec_arab_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="kota_kab_indo">Kota / Kabupaten (Indonesia)</label>
                                        <input type="text" name="kota_kab_indo" id="kota_kab_indo_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kota_kab_arab">Kota / Kabupaten (Arab)</label>
                                        <input type="text" name="kota_kab_arab" id="kota_kab_arab_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_wa">No Whatsapp</label>
                                        <input type="text" name="no_wa" id="no_wa_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="program">Program</label>
                                        <textarea name="program" id="program_edit" class="form-control form-control-sm"></textarea>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="pembayaran">Pembayaran</label>
                                        <input type="text" name="pembayaran" id="pembayaran_edit" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail_pembayaran">Detail Pembayaran</label>
                                        <textarea name="detail_pembayaran" id="detail_pembayaran_edit" class="form-control form-control-sm"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email_edit" class="form-control form-control-sm">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>Data Akademik</strong>
                            </div>
                            <div class="card-body" id="modalEditKelas">
                                <form id="formKelasPeserta">
                                    <input type="hidden" name="id_peserta">
                                    <div class="msgWl"></div>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-warning"><strong>List Waiting List</strong></li>
                                        <div id="list-wl"></div>
                                    </ul>
                                    <div class="msgKelas"></div>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-success"><strong>List Kelas</strong></li>
                                        <div id="list-kelas"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>

                        <div id="form-3">
                            <form id="formAddKelas">
                                <div class="msgAddKelas"></div>
                                <div class="alert alert-info"><i class="fa fa-info-circle text-info"></i> apabila kelas dikosongkan maka akan masuk waiting list</div>
                                <div class="form-group">
                                    <label for="detail_pembayaran">Detail Pembayaran</label>
                                    <textarea name="detail_pembayaran" id="detail_pembayaran_wl" class="form-control form-control-sm" readonly></textarea>
                                </div>
                                <?php if($konfirm == 0):?>
                                    <div class="form-group">
                                        <label for="catatan_edit">Catatan</label>
                                        <textarea name="catatan_edit" id="catatan_edit" class="form-control form-control-sm" readonly></textarea>
                                    </div>
                                <?php endif;?>
                                <input type="hidden" name="id_peserta">
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select name="id_kelas" id="id_kelas_add" class="form-control form-control-sm">
                                        <option value="">Pilih Kelas</option>
                                        <?php foreach ($kelas as $data) :?>
                                            <option value="<?= $data['id_kelas']?>"><?= $data['nama_kelas']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="program_add">Program</label>
                                    <select name="program_add" id="program_add" class="form-control form-control-sm" required>
                                        <option value="">Pilih Program</option>
                                        <?php foreach ($program as $data) :?>
                                            <option value="<?= $data['program']?>"><?= $data['program']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="periode_add">Periode</label>
                                    <input type="date" name="periode" id="periode_add" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type='submit' value='Tambah Kelas/WL' class='btn btn-sm btn-primary mt-3' id='btnTambahKelas'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal peserta -->

<!-- modal add peserta -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form id="formAdd">
                    <div class="form-group">
                        <label for="tgl_daftar">Tgl Daftar</label>
                        <input type="date" name="tgl_daftar" id="tgl_daftar_add" class="form-control form-control-sm"  value="<?= date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_indo">Nama Lengkap (Indonesia)</label>
                        <input type="text" name="nama_indo" id="nama_indo_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_arab">Nama Lengkap (Arab)</label>
                        <input type="text" name="nama_arab" id="nama_arab_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="t4_lahir_indo">Tempat Lahir (Indonesia)</label>
                        <input type="text" name="t4_lahir_indo" id="t4_lahir_indo_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="t4_lahir_arab">Tempat Lahir (Arab)</label>
                        <input type="text" name="t4_lahir_arab" id="t4_lahir_arab_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk_add" class="form-control form-control-sm" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desa_kel_indo">Desa / Kelurahan (Indonesia)</label>
                        <input type="text" name="desa_kel_indo" id="desa_kel_indo_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="desa_kel_arab">Desa / Kelurahan (Arab)</label>
                        <input type="text" name="desa_kel_arab" id="desa_kel_arab_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="kec_indo">Kecamatan (Indonesia)</label>
                        <input type="text" name="kec_indo" id="kec_indo_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="kec_arab">Kecamatan (Arab)</label>
                        <input type="text" name="kec_arab" id="kec_arab_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="kota_kab_indo">Kota / Kabupaten (Indonesia)</label>
                        <input type="text" name="kota_kab_indo" id="kota_kab_indo_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="kota_kab_arab">Kota / Kabupaten (Arab)</label>
                        <input type="text" name="kota_kab_arab" id="kota_kab_arab_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No Whatsapp</label>
                        <input type="text" name="no_wa" id="no_wa_add" class="form-control form-control-sm" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="program">Program</label>
                        <textarea name="program" id="program_add" class="form-control form-control-sm"></textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email_add" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="pembayaran">Pembayaran</label>
                        <input type="text" name="pembayaran" id="pembayaran_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="detail_pembayaran">Detail Pembayaran</label>
                        <textarea name="detail_pembayaran" id="detail_pembayaran_add" class="form-control form-control-sm">pendaftaran, keamanan, kaos, asrama</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Program</label>
                        <select name="program" id="program_add_belajar" class="form-control form-control-sm" required>
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $data) :?>
                                <option value="<?= $data['program']?>"><?= $data['program']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="perioe">Periode Belajar</label>
                        <input type="date" name="periode" id="periode_belajar" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Peserta" class="btn btn-sm btn-primary" id="btnmodalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add peserta -->

<script>
    $("#<?= $sidebar?>").addClass("active");
    
    // variabel untuk program
    let a = [];
    
    // cheklist accessories
    $("#dataTable").on("click", ".list", function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id_peserta = data[0];
        let nama = data[1];
        let status = data[2];
        let list = data[3];
        if(confirm(nama+" telah menerima "+list+"?")){
            $.ajax({
                url: "<?= base_url()?>peserta/edit_list",
                type: "POST",
                data: {id_peserta: id_peserta, list: list},
                success: function(){
                    reload_table();
                }
            })
        }
    })

    $(".btnModal").click(function(){
        delete_msg();
    })


    $('.program_add').click(function(){
        if($(this).prop("checked") == true){
            a.push($(this).val());
        }
        else if($(this).prop("checked") == false){
            let no = a.indexOf($(this).val());
            a.splice(no, 1);
        }
        console.log(a)
    });
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>peserta/periode_list",
            "type": "POST",
            // "success" : function(data){
            //     console.log(data)
            // }
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 4, 5, 6, 7, 8, 9, 10], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

    $("#formAdd").submit(function(){
        if(confirm("Yakin akan menambahkan peserta baru?")){
            let tgl_daftar = $('#tgl_daftar_add').val()
            let nik = $('#nik_add').val()
            let nama_indo = $('#nama_indo_add').val()
            let nama_arab = $('#nama_arab_add').val()
            let t4_lahir_indo = $('#t4_lahir_indo_add').val()
            let t4_lahir_arab = $('#t4_lahir_arab_add').val()
            let tgl_lahir = $('#tgl_lahir_add').val()
            let jk = $('#jk_add').val()
            let desa_kel_indo = $('#desa_kel_indo_add').val()
            let desa_kel_arab = $('#desa_kel_arab_add').val()
            let kec_indo = $('#kec_indo_add').val()
            let kec_arab = $('#kec_arab_add').val()
            let kota_kab_indo = $('#kota_kab_indo_add').val()
            let kota_kab_arab = $('#kota_kab_arab_add').val()
            let no_wa = $('#no_wa_add').val()
            let pembayaran = $('#pembayaran_add').val()
            let detail_pembayaran = $('#detail_pembayaran_add').val()
            let email = $('#email_add').val()
            let program = $('#program_add_belajar').val()
            let periode = $('#periode_belajar').val()

            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/add_peserta",
                dataType : "JSON",
                data : {tgl_daftar: tgl_daftar,nik: nik,nama_indo: nama_indo,nama_arab: nama_arab,t4_lahir_indo: t4_lahir_indo,t4_lahir_arab: t4_lahir_arab,tgl_lahir: tgl_lahir,jk:jk,desa_kel_indo: desa_kel_indo,desa_kel_arab: desa_kel_arab,kec_indo: kec_indo,kec_arab: kec_arab,kota_kab_indo: kota_kab_indo,kota_kab_arab: kota_kab_arab,no_wa: no_wa,pembayaran: pembayaran,detail_pembayaran: detail_pembayaran,email: email, program:program, periode:periode},
                success : function(data){
                    $("#formAdd").trigger("reset");
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan peserta baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-add-data').html(msg);
                    $("#modal-add").scrollTop(0);
                    reload_table();
                },
            })
        }
        return false;
    })
    
    $("#formEditPeserta").submit(function(){
        if(confirm("Yakin akan merubah data peserta?")){
            let id_peserta = $("input[name='id_peserta']").val()
            let tgl_daftar = $('#tgl_daftar_edit').val()
            let nik = $('#nik_edit').val()
            let nama_indo = $('#nama_indo_edit').val()
            let nama_arab = $('#nama_arab_edit').val()
            let t4_lahir_indo = $('#t4_lahir_indo_edit').val()
            let t4_lahir_arab = $('#t4_lahir_arab_edit').val()
            let tgl_lahir = $('#tgl_lahir_edit').val()
            let jk = $('#jk_edit').val()
            let desa_kel_indo = $('#desa_kel_indo_edit').val()
            let desa_kel_arab = $('#desa_kel_arab_edit').val()
            let kec_indo = $('#kec_indo_edit').val()
            let kec_arab = $('#kec_arab_edit').val()
            let kota_kab_indo = $('#kota_kab_indo_edit').val()
            let kota_kab_arab = $('#kota_kab_arab_edit').val()
            let no_wa = $('#no_wa_edit').val()
            let pembayaran = $('#pembayaran_edit').val()
            let detail_pembayaran = $('#detail_pembayaran_edit').val()
            let email = $('#email_edit').val()

            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/edit_peserta",
                dataType : "JSON",
                data : {id_peserta: id_peserta, tgl_daftar: tgl_daftar, nik: nik, nama_indo: nama_indo, nama_arab: nama_arab, t4_lahir_indo: t4_lahir_indo, t4_lahir_arab: t4_lahir_arab, tgl_lahir: tgl_lahir, jk:jk, desa_kel_indo: desa_kel_indo, desa_kel_arab: desa_kel_arab, kec_indo: kec_indo, kec_arab: kec_arab, kota_kab_indo: kota_kab_indo, kota_kab_arab: kota_kab_arab, no_wa: no_wa, pembayaran: pembayaran, detail_pembayaran: detail_pembayaran, email: email},
                success : function(data){
                    // $("#modalEditTitle").html(nama)
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditPeserta').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id_peserta);
                    reload_table();
                },
            })
        }
        return false;
    })
    
    $("#formAddKelas").submit(function(){
        if(confirm("Yakin akan menambahkan kelas peserta ini?")){
            var id = $("input[name='id_peserta']").val()
            var id_kelas = $("#id_kelas_add").val();
            var program = $("#program_add").val();
            var periode = $("#periode_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/add_kelas",
                dataType : "JSON",
                data : {id_kelas:id_kelas, id_peserta:id, program:program, periode:periode,},
                success : function(data){
                    if(data == 1){
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    } else {
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan kelas/waiting list peserta, karena peserta telah bergabung di kelas/waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    }
                    $('.msgAddKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    btn_3();
                    reload_table();
                }
            })
        }   
        return false;
    })

    $("#dataTable").on("click", ".detail", function(){
        const id = $(this).data('id');
        // console.log(id)
        detail(id)
        btn_1();
        delete_msg();
    })
    
    $("#dataTable").on("click", ".konfirmasi", function(){
        let data = $(this).data("id");
        data = data.split("|");
        nama = data[1]
        if(confirm("yakin akan mengkonfirmasi peserta atas nama "+nama+"?")){
            const id = data[0]
            $.ajax({
                url: "<?= base_url()?>/peserta/konfirmasi",
                method: "POST",
                dataType: "JSON",
                data: {id_user: id},
                success: function(data){
                    reload_table();
                    $(".msgPeserta").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil mengkonfirmasi peserta
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                }
            })
        }
    })
    
    $("#dataTable").on("click", ".peserta", function(){
        const id = $(this).data('id');
        detail(id)
        btn_2();
        delete_msg();
    })

    // delete peserta 
        $("#dataTable").on("click", ".delete_peserta", function(){
            let data = $(this).data("id");
            data = data.split("|")
            let id = data[0];
            let nama = data[1];
            if(confirm("Yakin akan menghapus peserta atas nama "+nama+"?")){
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_peserta",
                    type: "POST",
                    data: {id: id},
                    dataType: "JSON",
                    success: function(data){
                        reload_table();
                        $(".msgPeserta").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle text-success mr-1"></i> berhasil menghapus peserta
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                    }
                })
            }
        })
    // delete peserta 

    // btn buat id 
    $("#dataTable").on("click", "#btnAddId", function(){
        let data = $(this).data("id");
        data = data.split("|");
        let nama = data[1];
        if(confirm("Yakin akan membuat id peserta "+nama+"?")){
            let id = data[0];
            $.ajax({
                url: "<?= base_url()?>peserta/buat_id",
                method: "POST",
                dataType: "JSON",
                data: {id: id},
                success: function(data){
                    reload_table();
                    $(".msgPeserta").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil membuat id peserta
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                }
            })
        }
    })
    // btn buat id 

    // hapus wl 
        $("#list-wl").on("click", "#delete_wl", function(){
            if(confirm("Yakin akan menghapus waiting list?")){
                delete_msg()
                let id = $(this).data("id");
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_wl",
                    dataType: "JSON",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgWl').html(msg);
                        $("#modalDetail").scrollTop(0);
                        detail(data);
                        btn_2();
                        reload_table();
                    }
                })
            }
        })
    // hapus wl 
    
    // hapus kelas
        $("#list-kelas").on("click", "#delete_wl", function(){
            if(confirm("Yakin akan menghapus kelas ini?")){
                delete_msg()
                let id = $(this).data("id");
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_wl",
                    dataType: "JSON",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgKelas').html(msg);
                        $("#modalDetail").scrollTop(0);
                        detail(data);
                        btn_2();
                        reload_table();
                    }
                })
            }
        })
    // hapus kelas

    $("#dataTable").on("click", ".salin", function(){
        const id = $(this).data('id');
        console.log(id)
        salin(id)
    })

    // detail
        $("#btn-form-1").click(function(){
            btn_1();
            delete_msg();
        })
        
        $("#btn-form-2").click(function(){
            btn_2();
            delete_msg();
        })
        
        $("#btn-form-3").click(function(){
            btn_3();
            delete_msg();
        })
    // detail

    // function 
        function reload_table(){
            table.ajax.reload(null,false); //reload datatable ajax 
        }

        function salin(id){
            $.ajax({
                url : "<?=base_url()?>peserta/get_detail_peserta",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    // console.log(data)
                    // $("#modalAddTitle").html(data.nama_indo)
                    // $('#no_peserta_add').val(data.no_peserta)
                    // $('#tgl_daftar_add').val(data.tgl_daftar)
                    $('#nik_add').val(data.nik)
                    $('#nama_indo_add').val(data.nama_indo)
                    $('#nama_arab_add').val(data.nama_arab)
                    $('#t4_lahir_indo_add').val(data.t4_lahir_indo)
                    $('#t4_lahir_arab_add').val(data.t4_lahir_arab)
                    $('#tgl_lahir_add').val(data.tgl_lahir)
                    $('#jk_add').val(data.jk)
                    $('#desa_kel_indo_add').val(data.desa_kel_indo)
                    $('#desa_kel_arab_add').val(data.desa_kel_arab)
                    $('#kec_indo_add').val(data.kec_indo)
                    $('#kec_arab_add').val(data.kec_arab)
                    $('#kota_kab_indo_add').val(data.kota_kab_indo)
                    $('#kota_kab_arab_add').val(data.kota_kab_arab)
                    $('#no_wa_add').val(data.no_wa)
                    // $('#pembayaran_add').val(formatRupiah(data.pembayaran, "Rp"))
                    // $('#detail_pembayaran_add').val(data.detail_pembayaran)
                    $('#email_add').val(data.email)
                    // $("input[name='id_peserta']").val(data.id_peserta)
                }
            })
        }

        function detail(id){
            $.ajax({
                url : "<?=base_url()?>peserta/get_detail_peserta",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    // console.log(data)
                    $("#modalEditTitle").html(data.nama_indo)
                    $('#no_peserta_edit').val(data.no_peserta)
                    $('#tgl_daftar_edit').val(data.tgl_daftar)
                    $('#nik_edit').val(data.nik)
                    $('#nama_indo_edit').val(data.nama_indo)
                    $('#nama_arab_edit').val(data.nama_arab)
                    $('#t4_lahir_indo_edit').val(data.t4_lahir_indo)
                    $('#t4_lahir_arab_edit').val(data.t4_lahir_arab)
                    $('#tgl_lahir_edit').val(data.tgl_lahir)
                    $('#jk_edit').val(data.jk)
                    $('#desa_kel_indo_edit').val(data.desa_kel_indo)
                    $('#desa_kel_arab_edit').val(data.desa_kel_arab)
                    $('#kec_indo_edit').val(data.kec_indo)
                    $('#kec_arab_edit').val(data.kec_arab)
                    $('#kota_kab_indo_edit').val(data.kota_kab_indo)
                    $('#kota_kab_arab_edit').val(data.kota_kab_arab)
                    $('#no_wa_edit').val(data.no_wa)
                    $('#pembayaran_edit').val(formatRupiah(data.pembayaran, "Rp"))
                    $('#detail_pembayaran_edit').val(data.detail_pembayaran)
                    $('#detail_pembayaran_wl').val(data.detail_pembayaran)
                    $('#email_edit').val(data.email)
                    $("input[name='id_peserta']").val(data.id_peserta)

                    html = "";

                    if(data.user){
                        array = data.user;
                        array.forEach((user, i) => {
                            if(user.catatan == "") catatan = `<small class="form-text text-danger">isi catatan ini jika buku yang diterima peserta belum lengkap</small>`
                            else catatan = ``

                            if(user.buku == 0) {
                                btnBuku = `<a href="javascript:void(0)" id="buku" class="btn btn-sm btn-danger" data-id="`+user.id+`|`+data.nama_indo+`|`+user.kelas.program+`|`+user.id_peserta+`"><i class="fa fa-book"></i></a>`;
                                formCatatan = `<textarea name="catatan_buku" id="catatan_buku`+user.id+`" class="form-control form-control-sm mt-2">`+user.catatan+`</textarea>
                                <span id="msg-`+user.id+`">`+catatan+`</span>
                                <div class="d-flex justify-content-end mt-1">
                                    <a href="javascript:void(0)" id="btnCatatan" data-id="`+user.id+`|`+user.id_peserta+`" class="btn btn-sm btn-primary">Simpan</a>
                                </div>`;
                            } else {
                                btnBuku = `<a href="javascript:void(0)" class="btn btn-sm btn-primary"><i class="fa fa-book"></i></a>`;
                                formCatatan = '';
                            }
                            
                            html += `<li class="list-group-item">
                                <div class=" d-flex justify-content-between">
                                    <span>
                                        <a href="javascript:void(0)" id="delete_wl" class="mr-1" data-id="`+user.id+`"><i class="fa fa-minus-circle text-danger"></i></a>
                                        `+user.kelas.nama_kelas+`
                                    </span>
                                    <span>
                                        `+btnBuku+`
                                    </span>
                                </div>
                                `+formCatatan+`
                            </li>
                            `;
                        });
                        $("#list-kelas").html(html);
                        $("#btnHapus").show();
                    } else {
                        $("#list-kelas").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List kelas kosong</div>`);
                        $("#btnHapus").hide();
                    }
                    
                    html = "";
                    
                    if(data.wl){
                        array = data.wl;
                        array.forEach((user, i) => {
                            html += `<li class="list-group-item d-flex justify-content-between">
                                <span>
                                    <a href="javascript:void(0)" id="delete_wl" class="mr-1" data-id="`+user.id+`"><i class="fa fa-minus-circle text-danger"></i></a>
                                    `+user.program+`
                                </span>
                                <span>
                                    `+user.periode+`
                                </span>
                            </li>`;
                        });
                        $("#list-wl").html(html);
                        $("#list-wl").addClass("mb-3");
                    } else {
                        $("#list-wl").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> Waiting List kosong</div>`);
                        $("#list-wl").removeClass("mb-3");
                    }
                    
                }
            })
        }

        $("#list-kelas").on("click", "#btnCatatan", function(){
            let data = $(this).data("id");
            data = data.split("|");
            id = data[0];
            id_peserta = data[1];
            let catatan = $("#catatan_buku"+id).val();
            $.ajax({
                    url: "<?= base_url()?>peserta/add_catatan_buku",
                    data: {id: id, catatan: catatan},
                    method: "POST",
                    success: function(result){
                        delete_msg();
                        // detail(id_peserta);
                        btn_2();
                        $("#msg-"+id).html(`<small class="form-text text-success msg-catatan">Berhasil menambahkan catatan</small>`)
                    }
                })
        })

        $("#list-kelas").on("click", "#buku", function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let program = data[2];
            let id_peserta = data[3];

            if(confirm(nama+" telah menerima buku program "+program+"?")){
                $.ajax({
                    url: "<?= base_url()?>peserta/add_buku",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        detail(id_peserta);
                        btn_2();
                        reload_table();
                    }
                })
            }
        })
        
        function btn_1(){
            $("#btn-form-1").addClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
        }

        function btn_2(){ 
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").addClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
        }
        
        function btn_3(){
            $("#id_kelas_add").val("");
            $("#program_add").val("");
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }

        function delete_msg(){
            $(".msgWl").html("");
            $(".msgKelas").html("");
            $(".msgAddKelas").html("");
            $('.msgEditPeserta').html("");
            $('.msgEditKelas').html("");
            $('.msg-add-data').html("");
            $('.msgPeserta').html("");
            $('.msg-catatan').html("");
        }

        $("input[name=pembayaran]").keyup(function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
    // function 
</script>