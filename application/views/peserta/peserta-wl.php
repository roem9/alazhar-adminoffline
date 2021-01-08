<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800 mt-3"><?= $title?></h1>
            </div>
            <div class="">
                <!-- <a href="#modalAdd" data-toggle="modal" class="btn btn-success btn-sm mb-3 btnModal"><i class="fa fa-plus"></i> Tambah Peserta</a> -->
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
            <div class="card shadow mb-4" style="max-width: 800px">
                <div class="card-body">
                    <div id="reload">
                        <table id="dataTable" class="table table-sm cus-font">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="12%">ID</th>
                                    <th width="">Nama</th>
                                    <th width="25%">Program</th>
                                    <th width="15%">Periode</th>
                                    <th width=7%>Kelas</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add kelas -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body cus-font" id="modal-add">
                <div class="msg-add-data"></div>
                <form action="peserta/add_peserta" method="post" id="formAdd">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="program">Program</label>
                        <input type="text" name="program" id="program" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control form-control-sm" required>
                            <option value="">Pilih Kelas</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-danger mr-1" id="btnmodalDelete">Hapus</button>
                        <button type="button" class="btn btn-sm btn-primary" id="btnmodalAdd">Tambah Kelas</button>
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
<!-- modal add kelas -->

<script>
    $("#sidebarWlPeserta").addClass("active");
                             
    table = $('#dataTable').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?= base_url()?>peserta/wl_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [0, 5], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    });

    $("#dataTable").on("click", ".kelas", function(){
        let data = $(this).data("id");
        data = data.split("|");
        $("#id").val(data[0])
        $("#modalAddTitle").html(data[1]);

        let program = data[2];
        $("#program").val(program)
        $("#kelas").html(`<option value="">Pilih Kelas</option>`)

        $.ajax({
            type: "POST",
            url: "<?= base_url()?>kelas/get_kelas_aktif_program",
            dataType: "JSON",
            data: {program: program},
            success: function(data){
                let html = ""
                html += `<option value="">Pilih Kelas</option>`
                data.forEach(kelas => {
                    html += `<option value="`+kelas.id_kelas+`">[`+kelas.peserta+`] `+kelas.nama_kelas+`</option>`
                });

                $("#kelas").html(html)
            }
        })
    })

    $("#btnmodalAdd").click(function(){
        if(confirm("yakin akan menambahkan kelas?")){
            let id = $("#id").val()
            let id_kelas = $("#kelas").val();

            if(id_kelas != "") {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url()?>peserta/add_kelas_wl",
                    dataType: "JSON",
                    data: {id: id, id_kelas: id_kelas},
                    success: function(data){
                        reload_table();
                        $(".msgPeserta").html(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle text-success mr-1"></i> berhasil menambahkan kelas peserta
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`)
                        $("#modalAdd").modal('hide');
                    }
                })
            }

        }
        return false;
    })
    
    $("#btnmodalDelete").click(function(){
        if(confirm("yakin akan menghapus waiting list?")){
            let id = $("#id").val()
            $.ajax({
                method: "POST",
                url: "<?= base_url()?>peserta/delete_wl",
                dataType: "JSON",
                data: {id: id},
                success: function(data){
                    reload_table();
                    $(".msgPeserta").html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle text-success mr-1"></i> berhasil menghapus waiting list
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>`)
                    $("#modalAdd").modal('hide');
                }
            })
        }
        return false;
    })

    // function 
        function reload_table(){
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    // function 
</script>