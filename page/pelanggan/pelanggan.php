
<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Tabel Pelanggan</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
						<th>NO</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Email</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                      <tr>
						<th>NO</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Email</th>
						<th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("select * from tb_pelanggan");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['nama'] ?></td>
                            <td width="300px"><?php echo $data['alamat'] ?></td>
                            <td><?php echo $data['telpon'] ?></td>
                            <td><?php echo $data['email'] ?></td>
							<td>
								<a href="?page=pelanggan&aksi=ubah&id=<?php echo $data['kode_pelanggan'] ?>" class="btn btn-success">Edit</a> || 
								<a onclick="return confirm('Data ini akan di hapus')" href="?page=pelanggan&aksi=hapus&id=<?php echo $data['kode_pelanggan'] ?>" class="btn btn-danger">Hapus</a>
							</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
			<a href="?page=pelanggan&aksi=tambah" class="btn btn-primary">Tambah</a>
        </div>
    </div>
</div>