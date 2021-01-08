<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
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
            <div class="card shadow mb-4" style="max-width: 650px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="17%">Tgl Daftar</th>
                                    <th width="">Nama</th>
                                    <th width=7%>Konfirmasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <input type="hidden" name="id_peserta" id="id_peserta_add">
                    <div class="form-group">
                        <label for="tgl_daftar">Tgl Daftar</label>
                        <input type="date" name="tgl_daftar" id="tgl_daftar_add" class="form-control form-control-sm"required>
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
                    <!-- <div class="form-group">
                        <label for="">Pilih Program</label>
                        <div class="row">
                            <?php foreach ($program as $data) :?>
                                <div class="col-4">
                                    <input type="checkbox" name="program" class="program_add mr-1" id="<?= $data['program']?>" value="<?= $data['program']?>"><label for="<?= $data['program']?>"><?= $data['program']?></label>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div> -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-danger mr-1" id="btnmodalHapus">Hapus</button>
                        <input type="submit" value="Konfirmasi Peserta" class="btn btn-sm btn-primary" id="btnmodalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add peserta -->

<script>
    $("#sidebarKonfirmPeserta").addClass("active");
    
    // variabel untuk program
    let a = [];

    $('.program_add').click(function(){
        if($(this).prop("checked") == true){
            a.push($(this).val());
        }
        else if($(this).prop("checked") == false){
            let no = a.indexOf($(this).val());
            a.splice(no, 1);
        }
    });
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>peserta/ajax_list/<?= $konfirm?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 3], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

    $("#btnmodalHapus").click(function(){
        let id_peserta = $('#id_peserta_add').val()
            if(confirm("Yakin akan menghapus peserta ini?")){
                $.ajax({
                    url: "<?= base_url()?>peserta/delete_peserta",
                    type: "POST",
                    data: {id: id_peserta},
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
                        $("#modalAdd").modal('hide');
                    }
                })
            }
    })

    $("#formAdd").submit(function(){
        if(confirm("Yakin akan mengkonfirmasi peserta ini?")){
            let id_peserta = $('#id_peserta_add').val()
            let tgl_daftar = $('#tgl_daftar_add').val()
            let nik = $('#nik_add').val()
            let nama_indo = $('#nama_indo_add').val()
            let nama_arab = $('#nama_arab_add').val()
            let t4_lahir_indo = $('#t4_lahir_indo_add').val()
            let t4_lahir_arab = $('#t4_lahir_arab_add').val()
            let tgl_lahir = $('#tgl_lahir_add').val()
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

            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/konfirm_peserta",
                dataType : "JSON",
                data : {id_peserta: id_peserta, tgl_daftar: tgl_daftar,nik: nik,nama_indo: nama_indo,nama_arab: nama_arab,t4_lahir_indo: t4_lahir_indo,t4_lahir_arab: t4_lahir_arab,tgl_lahir: tgl_lahir,desa_kel_indo: desa_kel_indo,desa_kel_arab: desa_kel_arab,kec_indo: kec_indo,kec_arab: kec_arab,kota_kab_indo: kota_kab_indo,kota_kab_arab: kota_kab_arab,no_wa: no_wa,pembayaran: pembayaran,detail_pembayaran: detail_pembayaran,email: email, program: a},
                success : function(data){
                    // console.log(data)
                    $("#modalAdd").modal('hide');
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengkonfirmasi peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgPeserta').html(msg);
                    reload_table();
                },
            })
        }
        return false;
    })
    
    $("#dataTable").on("click", ".konfirmasi", function(){
        const id = $(this).data('id');
        // console.log(id)
        detail(id)
    })

    // function 
        function reload_table(){
            table.ajax.reload(null,false); //reload datatable ajax 
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
                    $("#modalAddTitle").html(data.nama_indo)
                    $('#no_peserta_add').val(data.no_peserta)
                    $('#tgl_daftar_add').val(data.tgl_daftar)
                    $('#nik_add').val(data.nik)
                    $('#nama_indo_add').val(data.nama_indo)
                    $('#nama_arab_add').val(data.nama_arab)
                    $('#t4_lahir_indo_add').val(data.t4_lahir_indo)
                    $('#t4_lahir_arab_add').val(data.t4_lahir_arab)
                    $('#tgl_lahir_add').val(data.tgl_lahir)
                    $('#desa_kel_indo_add').val(data.desa_kel_indo)
                    $('#desa_kel_arab_add').val(data.desa_kel_arab)
                    $('#kec_indo_add').val(data.kec_indo)
                    $('#kec_arab_add').val(data.kec_arab)
                    $('#kota_kab_indo_add').val(data.kota_kab_indo)
                    $('#kota_kab_arab_add').val(data.kota_kab_arab)
                    $('#no_wa_add').val(data.no_wa)
                    $('#pembayaran_add').val(formatRupiah(data.pembayaran, "Rp"))
                    $('#detail_pembayaran_add').val(data.detail_pembayaran)
                    $('#email_add').val(data.email)
                    $("input[name='id_peserta']").val(data.id_peserta)
                }
            })
        }

        $("input[name=pembayaran]").keyup(function(){
            $(this).val(formatRupiah(this.value, 'Rp. '))
        })
    // function 
</script>