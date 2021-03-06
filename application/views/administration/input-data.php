<?php $row = $this->db->query("SELECT id_anggaran FROM tbl_anggaran ORDER BY id_anggaran DESC LIMIT 1")->row();
$nextIdAnggaran = $row->id_anggaran + 1;
// echo $nextIdAnggaran;
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggaran</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?php echo site_url('dashboard/input_admin_proses') ?>" method="POST">
                        <div class="form-group">
                            <label>Biaya Administrasi</label>
                        </div>

                        <input type="hidden" value="<?php echo $nextIdAnggaran ?>" name="id_anggaran" />
                        <div class="form-group">
                            <label>Klien</label>
                            <select class="form-control" name="klien">
                                <?php
                                foreach ($klien as $k) {
                                ?>
                                    <option value="<?php echo $k->id_klien ?>"><?php echo $k->nama_perusahaan ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun-anggaran">
                                <?php $tahun = ['2019', '2020'];
                                for ($t = 2019; $t <= date('Y'); $t++) {
                                ?>
                                    <option value="<?php echo $t ?>"><?php echo $t ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                Bulan
                            </label>
                            <select class="form-control" name="bulan-anggaran">
                                <?php foreach ($bulan as $b) { ?>
                                    <option value="<?php echo $b->id_bulan ?>"><?php echo $b->nama_bulan ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                Pos
                            </label>
                            <select class="form-control" name="pos-anggaran">
                                <?php foreach ($pos as $p) { ?>
                                    <option value="<?php echo $p->id_pos ?>"><?php echo $p->nama_pos ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>
                                Detail Anggaran
                            </label>
                            <div class="table-responsive">
                                <table class="table table-borderless" id="detail-anggaran">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Uraian</th>
                                            <th>Volume</th>
                                            <th>Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Pengeluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input type="text" name="uraian[]" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="number" name="volume[]" class="form-control" />
                                            </td>
                                            <td>
                                                <select class="form-control" name="satuan[]">
                                                    <option value="paket">Paket</option>
                                                    <option value="personel">Personel</option>
                                                    <option value="buku">Buku</option>
                                                    <option value="bulan">Bulan</option>
                                                    <option value="tahun">Tahun</option>
                                            </td>
                                            <td>
                                                <input type="number" name="harga-satuan[]" class="form-control" />
                                            </td>
                                            <td>
                                                <input type="number" name="pengeluaran[]" class="form-control" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-primary" href="javascript:void(0)" onclick="return addRows()">Tambah Inputan</a>
                            </div>
                        </div>
                        <div class="from-group text-right">
                            <input type="submit" class="btn btn-success" value="Simpan" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

</div>
<!-- /.container-fluid -->

</div>

<script>
    var urut = 1;

    function addRows() {
        var prm = prompt("Mau tambah berapa baris ?", 1);
        for (var i = 1; i <= prm; i++) {
            var table = document.getElementById('detail-anggaran');
            var lengthRow = document.getElementById('detail-anggaran').rows.length;
            var row = table.insertRow(lengthRow);
            var nomorUrut = row.insertCell(0);
            nomorUrut.innerHTML = ++urut;
            var uraian = row.insertCell(1);
            uraian.innerHTML = '<input type="text" name="uraian[]" class="form-control" required/>';
            var volume = row.insertCell(2);
            volume.innerHTML = '<input type="number" name="volume[]" class="form-control" required/>';
            var satuan = row.insertCell(3);
            satuan.innerHTML = '<select class="form-control" name="satuan[]" required>' +
                '<option value="paket">Paket</option>' +
                '<option value="personel">Personel</option>' +
                '<option value="buku">Buku</option>' +
                '<option value="bulan">Bulan</option>' +
                '<option value="tahun">Tahun</option>' +
                '</select>';

            var hrgSatuan = row.insertCell(4);
            hrgSatuan.innerHTML = '<input type="number" name="harga-satuan[]" required class="form-control" />';
            var pengeluaran = row.insertCell(5);
            pengeluaran.innerHTML = '<input type="number" name="pengeluaran[]" required class="form-control" />';
        }
    }
</script>
<!-- End of Main Content -->