<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div class="d-flex justify-content-begin mt-3">
                    <h3 class="h3 mb-0 text-gray-800 mr-3"><?= $title?></h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-dark" style="font-size: 12px" border=1>
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tgl Daftar</th>
                            <th>Nama Peserta</th>
                            <th>Tipe</th>
                            <th>Tempat Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>JK</th>
                            <th>Pendidikan</th>
                            <th>Status</th>
                            <th>No. Handphone</th>
                            <th>Program</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Pengajar</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Kd Pos</th>
                            <th>No. Telp</th>
                            <th>Pekerjaan</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 0;
                        foreach ($peserta as $data) :?>
                            <tr>
                                <td><?= ++$no?></td>
                                <td><?= date("d-m-Y", strtotime($data['peserta']['tgl_masuk']))?></td>
                                <td><?= $data['peserta']['nama_peserta']?></td>
                                <td><?= $data['peserta']['tipe_peserta']?></td>
                                <td><?= $data['peserta']['t4_lahir']?></td>
                                <td><?= $data['peserta']['tgl_lahir']?></td>
                                <td><?= $data['peserta']['jk']?></td>
                                <td><?= $data['peserta']['pendidikan']?></td>
                                <td><?= $data['peserta']['status_nikah']?></td>
                                <td>'<?= $data['peserta']['no_hp']?></td>
                                <td><?= $data['kelas']['program']?></td>
                                <td><?= $data['jadwal']['hari']?></td>
                                <td><?= $data['jadwal']['jam']?></td>
                                <td><?= $data['jadwal']['tempat']?></td>
                                <td><?= $data['kpq']['nama_kpq']?></td>
                                <td><?= $data['alamat']['alamat']?></td>
                                <td><?= $data['alamat']['provinsi']?></td>
                                <td><?= $data['alamat']['kab_kota']?></td>
                                <td><?= $data['alamat']['kec']?></td>
                                <td><?= $data['alamat']['kel']?></td>
                                <td><?= $data['alamat']['kd_pos']?></td>
                                <td><?= $data['alamat']['no_telp']?></td>
                                <td><?= $data['pekerjaan']['pekerjaan']?></td>
                                <td><?= $data['ortu']['nama_ayah']?></td>
                                <td><?= $data['ortu']['nama_ibu']?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>