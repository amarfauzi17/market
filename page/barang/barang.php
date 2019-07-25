
<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Tabel Barang
	</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
						<th>NO</th>
                        <th>Kode Barcode</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Profit</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                      <tr>
						<th>NO</th>
                        <th>Kode Barcode</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stok</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Profit</th>
						<th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("select * from tb_barang");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['kode_barcode'] ?></td>
                            <td><?php echo $data['nama_barang'] ?></td>
                            <td><?php echo $data['satuan'] ?></td>
                            <td><?php echo $data['stock'] ?></td>
                            <td><?php echo $data['harga_beli'] ?></td>
                            <td><?php echo $data['harga_jual'] ?></td>
                            <td><?php echo $data['profit'] ?></td>
							<td>
								<a href="?page=barang&aksi=ubah&id=<?php echo $data['kode_barcode'] ?>" class="btn btn-success">Edit</a> || 
								<a onclick="return confirm('Data ini akan di hapus')" href="?page=barang&aksi=hapus&id=<?php echo $data['kode_barcode'] ?>" class="btn btn-danger">Hapus</a>
							</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
			<a href="?page=barang&aksi=tambah" class="btn btn-primary">Tambah</a>
			<a href="page/barang/cetak.php" target="_blank" class="btn btn-success">Cetak</a>
        </div>
    </div>
</div>