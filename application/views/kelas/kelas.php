<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Kelas</a>
                <a onclick="reload_table()" data-toggle="modal" class="btn btn-sm btn-info mb-3 text-light"><i class="fa fa-sync"></i> Reload</a>
            </div>
            <div class="notification">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="msgKelas">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4" style="max-width: 1100px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th style="width: 6%">Status</th>
                                    <th style="width: 9%">Tgl. Mulai</th>
                                    <th style="width: 9%">Tgl. Cetak</th>
                                    <th>Nama Kelas</th>
                                    <th style="width: 17%"><center>Program</center></th>
                                    <th style="width: 5%">Peserta</th>
                                    <th style="width: 5%">Wl</th>
                                    <th style="width: 5%">Detail</th>
                                    <th style="width: 5%">Syahadah</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal kelas -->
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
                                <a href="javascript:void(0)" class='nav-link active' id="btn-form-1"><i class="fas fa-book"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-users"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-3"><i class="fas fa-clock"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div id="form-1">
                            <!-- <div class="card" id="form-1"> -->
                            <div class="card mb-3">
                                <div class="card-header text-primary">
                                    <strong>Data Kelas</strong>
                                </div>
                                <div class="card-body">
                                    <div class="msgEditKelas"></div>
                                    <form action="kelas/edit_kelas" method="post" id="formEditKelas">
                                        <input type="hidden" name="id_kelas">
                                        <div class="form-group">
                                            <label for="nama_kelas">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" id="nama_kelas_edit" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program</label>
                                            <select name="program" id="program_edit" class="form-control form-control-sm">
                                                <option value="">Pilih Program</option>
                                                <?php foreach ($program as $data) :?>
                                                    <option value="<?= $data['program']?>"><?= $data['program']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_mulai">Tgl. Mulai</label>
                                            <input type="date" name="tgl_mulai" id="tgl_mulai_edit" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_selesai">Tgl. Selesai</label>
                                            <input type="date" name="tgl_selesai" id="tgl_selesai_edit" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_cetak">Tgl. Cetak Syahadah</label>
                                            <input type="date" name="tgl_cetak" id="tgl_cetak_edit" class="form-control form-control-sm">
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" value="Ubah Data" class="btn btn-sm btn-success" id="btnEdit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header text-primary">
                                    <strong>Link Input Nilai</strong>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <div class="link-input-nilai"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="form-2">
                            <div class="card-header text-primary">
                                <strong>List Peserta <span class="badge badge-info" id="jumPeserta">0</span></strong>
                            </div>
                            <div class="card-body">
                                <div class="msgHapusPeserta"></div>
                                <form action="kelas/delete_peserta" method="post" id="formDeletePeserta">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-peserta"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        
                        <div class="card" id="form-3">
                            <div class="card-header text-primary">
                                <strong>Waiting list Peserta <span class="badge badge-info" id="jumWlPeserta">0</span></strong>
                            </div>
                            <div class="card-body">
                                <div class="msgHapusPeserta"></div>
                                <form action="kelas/delete_peserta" method="post" id="formWlPeserta">
                                    <input type="hidden" name="id_kelas">
                                    <ul class="list-group">
                                        <div id="list-wl-peserta"></div>
                                    </ul>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal kelas -->

<!-- modal add kelas -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form action="kelas/add_kelas" method="post" id="formAdd">
                    <div class="form-group">
                        <label for="tgl_mulai">Tgl. Mulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai_add" class="form-control form-control-sm" value="<?= date('Y-m-d')?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_selesai">Tgl. Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="tgl_cetak">Tgl. Cetak Syahadah</label>
                        <input type="date" name="tgl_cetak" id="tgl_cetak_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" id="program_add" class="form-control form-control-sm" required>
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $data) :?>
                                <option value="<?= $data['program']?>"><?= $data['program']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas_add" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Kelas" class="btn btn-sm btn-primary" id="btnModalAdd">
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add kelas -->
<script>
    $("#sidebarKelas").addClass("active");
    
    $(".btnModal").click(function(){
        delete_msg();
    })
                                    
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>kelas/ajax_list/<?= $status?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 6, 7, 8, 9], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });
    
    $("#formAdd").submit(function(){
        if(confirm("Yakin akan menambahkan kelas baru?")){
            var tgl_mulai = $("#tgl_mulai_add").val();
            var tgl_selesai = $("#tgl_selesai_add").val();
            var tgl_cetak = $("#tgl_cetak_add").val();
            var nama_kelas = $("#nama_kelas_add").val();
            var program = $("#program_add").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>kelas/add_kelas",
                dataType : "JSON",
                data : {tgl_mulai : tgl_mulai,tgl_selesai : tgl_selesai,tgl_cetak : tgl_cetak,nama_kelas : nama_kelas,program : program},
                success : function(data){
                    $("#formAdd").trigger("reset");
                    
                    $("#tgl_mulai_add").val(tgl_mulai);
                    $("#tgl_selesai_add").val(tgl_selesai);
                    $("#tgl_cetak_add").val(tgl_cetak);
                    
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas baru<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msg-add-data').html(msg);
                    $("#modal-add").scrollTop(0);
                    reload_table();
                },
            })
        }
        return false;
    })

    $("#formEditKelas").submit(function(){
        if(confirm("Yakin akan merubah data kelas ini?")){
            var id = $("input[name='id_kelas']").val()
            var nama_kelas = $("#nama_kelas_edit").val();
            var program = $("#program_edit").val();
            var tgl_mulai = $("#tgl_mulai_edit").val();
            var tgl_selesai = $("#tgl_selesai_edit").val();
            var tgl_cetak = $("#tgl_cetak_edit").val();
            var id_civitas = $("#id_civitas_edit").val();
            $.ajax({
                type : "POST",
                url : "<?= base_url()?>kelas/edit_kelas",
                dataType : "JSON",
                data : {id_kelas : id,nama_kelas : nama_kelas,program : program,tgl_mulai : tgl_mulai,tgl_selesai : tgl_selesai,tgl_cetak : tgl_cetak,id_civitas : id_civitas},
                success : function(data){
                    // $("#modalEditTitle").html(nama)
                    var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil merubah data kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                    $('.msgEditKelas').html(msg);
                    $("#modalDetail").scrollTop(0);
                    detail(id);
                    reload_table();
                }
            })
        }
        return false;
    })
    
    // when detail button clicked
    $("#dataTable").on("click", ".detail", function(){
        a = [];
        $("#select1").html(0);
        const id = $(this).data('id');
        detail(id)
        btn_1();
        delete_msg();
    })
    
    // when count peserta clicked
    $("#dataTable").on("click", ".peserta", function(){
        a = [];
        $("#select1").html(0);
        const id = $(this).data('id');
        detail(id)
        btn_2();
        delete_msg();
    })
    
    // when count wl clicked
    $("#dataTable").on("click", ".wl", function(){
        a = [];
        $("#select1").html(0);
        const id = $(this).data('id');
        detail(id)
        btn_3();
        delete_msg();
    })

    // when status clicked
    $("#dataTable").on("click", "#btnStatusKelas", function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id = data[0];
        let nama = data[1];
        let status = data[2]

        if(confirm("Yakin akan "+status+" kelas "+nama+"?")){
            $.ajax({
                url: "<?= base_url()?>kelas/edit_status_kelas",
                type: "POST",
                data: {id: id},
                dataType: "JSON",
                success: function(data){
                    reload_table();
                    $(".msgKelas").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil mengganti status kelas
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                }
            })
        }
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
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }

        function delete_msg(){
            $('.msgHapusPeserta').html("");
            $('.msgEditKelas').html("");
            $('.msg-add-data').html("");
            $('.msgListPertemuan').html("");
            $('.msgKelas').html("");
        }

        function detail(id){
            $.ajax({
                url : "<?=base_url()?>kelas/get_detail_kelas",
                method : "POST",
                data : {id : id},
                async : true,
                dataType : 'json',
                success : function(data){
                    $("#modalEditTitle").html(data.nama_kelas);
                    $("input[name='id_kelas']").val(data.id_kelas);
                    $("#nama_kelas_edit").val(data.nama_kelas);
                    $("#program_edit").val(data.program);
                    $("#tgl_mulai_edit").val(data.tgl_mulai)
                    $("#tgl_selesai_edit").val(data.tgl_selesai)
                    $("#tgl_cetak_edit").val(data.tgl_cetak)

                    let html = "";

                    data.link.forEach(link => {
                        html += `<li class="list-group-item list-group-item-success"><strong>`+link.pelajaran+`</strong></li><li class="list-group-item">`+link.link+`</li>`
                    });
                    $(".link-input-nilai").html(html);

                    html = "";

                    if(data.peserta){
                        $("#jumPeserta").html(data.peserta.length)
                        data.peserta.forEach((element, i) => {
                            if(element.no_syahadah == 0) {
                                btnDelete = `<a href="javascript:void(0)" id="keluar_kelas" class="mr-1" data-id="`+element.id+`|`+element.nama_indo+`|`+data.nama_kelas+`"><i class="fa fa-minus-circle text-danger"></i></a>`
                                btnSyahadah = `<a href="javascript:void(0)" id="buatSyahadah" data-id="`+element.id+`|`+element.nama_indo+`|`+data.nama_kelas+`|`+data.id_kelas+`|" class="btn btn-sm btn-outline-warning"><i class="fa fa-award"></i></a>`
                            } else {
                                btnDelete = ""
                                btnSyahadah = `<a target="_blank" href="<?= base_url()?>syahadah/peserta/`+element.link+`" class="btn btn-sm btn-warning"><i class="fa fa-award"></i></a>`

                            }
                            
                            html += `<li class="list-group-item d-flex justify-content-between">
                                        <span>
                                            `+btnDelete+`
                                            `+element.nama_indo+`
                                        </span>
                                        <span>
                                            `+btnSyahadah+`
                                        </span>
                                    </li>`;
                        });
                        
                        $("#list-peserta").html(html);
                    } else {
                        $("#jumPeserta").html(0)
                        $("#list-peserta").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List peserta kosong</div>`);
                    }
                    
                    html = "";

                    if(data.wl){
                        $("#jumWlPeserta").html(data.wl.length)
                        data.wl.forEach((element, i) => {
                            html += `<li class="list-group-item d-flex justify-content-between">
                                        <span>
                                            <a href="javascript:void(0)" id="delete_wl" class="mr-1" data-id="`+element.id+`|`+element.nama_indo+`|`+data.program+`|`+data.id_kelas+`"><i class="fa fa-minus-circle text-danger"></i></a>
                                            `+element.nama_indo+` (`+element.periode+`)
                                        </span>
                                        <span>
                                            <a href="javascript:void(0)" id="add_kelas_wl" data-id="`+element.id+`|`+element.nama_indo+`|`+data.nama_kelas+`|`+data.id_kelas+`"><i class="fa fa-plus-circle text-success"></i></a>
                                        </span>
                                    </li>`;
                        });
                        
                        $("#list-wl-peserta").html(html);
                    } else {
                        $("#jumWlPeserta").html(0)
                        $("#list-wl-peserta").html(`<div class="alert alert-warning"><i class="fa fa-exclamation-circle mr-1 text-warning"></i> List peserta kosong</div>`);
                    }
                }
            })
        }        
    // function 
    
    // hapus peserta dari kelas
        $("#list-peserta").on('click', '#keluar_kelas', function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            if(confirm("Yakin akan mengeluarkan "+nama+" dari kelas "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/keluar_kelas",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari kelas ini<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })
        
    // buat syahadah
        $("#list-peserta").on('click', '#buatSyahadah', function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            let id_kelas = data[3];
            if(confirm("Yakin akan membuat syahadah untuk "+nama+" dari kelas "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/buat_syahadah",
                    data: {id: id},
                    method: "POST",
                    success: function(data){
                        // console.log(data)
                        detail(id_kelas);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil membuat syahadah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })

    // masukkan waiting list ke kelas
        $("#list-wl-peserta").on("click", "#add_kelas_wl", function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            let id_kelas = data[3]
            if(confirm("Yakin akan menambahkan "+nama+" ke kelas "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/add_kelas_wl",
                    data: {id: id, id_kelas: id_kelas},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil memasukkan peserta ke kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })
    
    // hapus peserta dari waiting list 
        $("#list-wl-peserta").on('click', '#delete_wl', function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id = data[0];
            let nama = data[1];
            let kelas = data[2];
            let id_kelas = data[3]
            if(confirm("Yakin akan menghapus "+nama+" dari waiting list "+kelas+"?")){
                $.ajax({
                    url: "<?= base_url()?>kelas/delete_wl",
                    data: {id: id, id_kelas: id_kelas},
                    method: "POST",
                    success: function(data){
                        detail(data);
                        reload_table();
                        var msg = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus peserta dari waiting list<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('.msgHapusPeserta').html(msg);
                    }
                })
            }
        })
</script>
