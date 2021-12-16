<?php
if (!empty($this->session->flashdata('info'))) { ?>

    <div class="alert alert-success" role="alert"><?= $this->session->flashdata('info'); ?></div>

<?php
}

?>

<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url() ?>peminjaman/tambah_peminjaman" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Peminjam</a>
    </div>

</div>
<br>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id peminjaman</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $row) {
                    $tgl_kembali = new DateTime($row->tgl_kembali);
                    $tgl_sekarang = new DateTime();
                    $selisih = $tgl_sekarang->diff($tgl_kembali)->format("%a");
                ?>
                    <tr>
                        <td><?= $row->id_pm; ?></td>
                        <td><?= $row->nama_anggota; ?></td>
                        <td><?= $row->judul_buku; ?></td>
                        <td><?= mediumdate_indo($row->tgl_pinjam); ?></td>
                        <td><?= mediumdate_indo($row->tgl_kembali); ?></td>
                        <td>
                            <?php
                            if ($tgl_kembali >= $tgl_sekarang or $selisih == 0) {
                                echo "<span class='label label-warning'>Belum di Kembalian</span>";
                            } else {
                                echo "Telat <b style = 'color:red;'>" . $selisih . "</b> Hari <br> <span class='label label-danger'> Denda Perhari = 1.000 ";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url() ?>peminjaman/kembalikan/<?= $row->id_pm ?>" class="btn btn-primary btn-xs" onclick="return confirm('yakin, buku ini akan dikembalikan??')">kembalikan</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>