<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Civitas</a>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="card shadow mb-4" style="max-width: 700px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Status</th>
                                    <th width="14%">ID</th>
                                    <th width="">Nama</th>
                                    <th width=7%>Detail</th>
                                    <th width=7%>Login</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add civitas -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Civitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form action="civitas/add_civitas" method="post" id="formAdd">
                    <div class="form-group">
                        <label for="tgl_masuk ">Tgl Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk_add" class="form-control form-control-sm"  value="<?= date("Y-m-d");?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_civitas">Nama Lengkap</label>
                        <input type="text" name="nama_civitas" id="nama_civitas_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="t4_lahir">Tempat Lahir</label>
                        <input type="text" name="t4_lahir" id="t4_lahir_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat_add" class="form-control form-control-sm" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>
                        <input type="text" name="no_hp" id="no_hp_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Peserta" class="btn btn-sm btn-primary" id="btnmodalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add civitas -->

<!-- modal edit civitas -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body cus-font" id="modalDetail">
                    <div class="msgEditCivitas"></div>
                    <form action="civitas/add_civitas" method="post" id="formEditCivitas">
                        <input type="hidden" name="id_civitas">
                        <div class="form-group">
                            <label for="tgl_masuk ">Tgl Masuk</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk_edit" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" name="username" id="username_edit" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_civitas">Nama Lengkap</label>
                            <input type="text" name="nama_civitas" id="nama_civitas_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="t4_lahir">Tempat Lahir</label>
                            <input type="text" name="t4_lahir" id="t4_lahir_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tgl Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat_edit" class="form-control form-control-sm" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="text" name="no_hp" id="no_hp_edit" class="form-control form-control-sm" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnModalEdit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- modal edit civitas -->

<script>
    $("#sidebarCivitas").addClass("active");
     
    // kelas
    let a = [];

    $(".btnModal").click(function(){
        delete_msg();
    })
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>civitas/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 4], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

    $("#formAdd").submit(function(){
        if(confirm("Yakin akan menambahkan civitas baru?")){
            var tgl_masuk = $("#tgl_masuk_add").val();
            var nama_civitas = $("#nama_civitas_add").val();
            var t4_lahir = $("#t4_lahir_add").val();
            var tgl_lahir = $("#tgl_lahir_add").val();
            var alamat = $("#alamat_add").val();
            var no_hp = $("#no_hp_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>civitas/add_civitas",
                dataType : "JSON",
                data : {tgl_masuk : tgl_masuk,nama_civitas : nama_civitas,t4_lahir : t4_lahir,tgl_lahir : tgl_lahir,alamat : alamat,no_hp : no_hp},
                success : function(data){
                    $("#formAdd").trigger("reset");
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan civitas baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-add-data').html(msg);
                    $("#modal-add").scrollTop(0);
                    reload_table();
                }
            })
        }
        return false;
    })
    
    $("#formEditCivitas").submit(function(){
        if(confirm("Yakin akan merubah data civitas?")){
            var id = $("input[name='id_civitas']").val()
            var nama_civitas = $("#nama_civitas_edit").val();
            var t4_lahir = $("#t4_lahir_edit").val();
            var tgl_lahir = $("#tgl_lahir_edit").val();
            var alamat = $("#alamat_edit").val();
            var no_hp = $("#no_hp_edit").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>civitas/edit_civitas",
                dataType : "JSON",
                data : {id_civitas:id, nama_civitas : nama_civitas,t4_lahir : t4_lahir,tgl_lahir : tgl_lahir,alamat : alamat,no_hp : no_hp},
                success : function(data){
                    // $("#modalEditTitle").html(nama)
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data civitas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditCivitas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    var msg = `
                        <span class="fas icon-msg fa-times-circle"></span>
                        <span class="msg">Gagal menambahkan kelas baru</span>
                        <span class="close-msg">
                            <span class="fas fa-times"></span>
                        </span>`;
                    $('.notification').html(msg);
                    $('.notification').addClass("show");
                    $('.notification').addClass("danger");
                    $('.notification').removeClass("hide");
                    $('.notification').addClass("showAlert");
                    setTimeout(function(){
                        $('.notification').removeClass("show");
                        $('.notification').addClass("hide");
                    },5000);
                }
            })
        }
        return false;
    })

    $("#formKelasPeserta").submit(function(){
        if(confirm("Yakin akan menghapus kelas peserta ini?")){
            if((a === undefined || a.length == 0)){
                var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Untuk menghapus kelas peserta silahkan menandai checkbox terlebih dahulu<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                $('.msgEditKelas').html(msg);
                $("#modalDetail").scrollTop(0);
            }
            var id = $("input[name='id_user']").val()
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/remove_kelas",
                dataType : "JSON",
                data : {id:a},
                success : function(data){
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    btn_2();
                    reload_table();
                }
            })
        }   
        return false;
    })

    $('#formKelasPeserta').on('click', 'input[type="checkbox"][name="id[]"]', function(){
        if($(this).prop("checked") == true){
            a.push($(this).val());
            $("#kelas").html(a.length);
        }
        else if($(this).prop("checked") == false){
            let no = a.indexOf($(this).val());
            a.splice(no, 1);
            $("#kelas").html(a.length);
        }
    });
    
    $("#formAddKelas").submit(function(){
        if(confirm("Yakin akan menambahkan kelas peserta ini?")){
            var id = $("input[name='id_user']").val()
            var id_kelas = $("#id_kelas_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>peserta/add_kelas",
                dataType : "JSON",
                data : {id_kelas:id_kelas, id_user:id},
                success : function(data){
                    if(data == 1){
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    } else {
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan kelas peserta, karena peserta telah bergabung di kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    }
                    $('.msgEditKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    btn_2();
                    reload_table();
                }
            })
        }   
        return false;
    })

    $("#dataTable").on("click", ".detail", function(){
        const id = $(this).data('id');
        detail(id)
        delete_msg();
    })
    
    $("#dataTable").on("click", ".peserta", function(){
        a = [];
        $("#kelas").html(0);
        const id = $(this).data('id');
        detail(id)
        btn_2();
        delete_msg();
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

        function detail(id){
            $.ajax({
                url : "<?=base_url()?>civitas/get_detail_civitas",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#modalEditTitle").html(data.nama_civitas)
                    $("input[name='id_civitas']").val(data.id_civitas)
                    $("#tgl_masuk_edit").val(data.tgl_masuk)
                    $("#username_edit").val(data.username)
                    $("#nama_civitas_edit").val(data.nama_civitas)
                    $("#t4_lahir_edit").val(data.t4_lahir)
                    $("#tgl_lahir_edit").val(data.tgl_lahir)
                    $("#alamat_edit").val(data.alamat)
                    $("#no_hp_edit").val(data.no_hp)
                }
            })
        }

        function delete_msg(){
            $('.msgEditCivitas').html("");
            $('.msg-add-data').html("");
        }
    // function 
</script>