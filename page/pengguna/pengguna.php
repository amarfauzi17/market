
<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Data Tabel Pengguna</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
						<th>NO</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Level</th>
						<th>Foto</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                      <tr>
						<th>NO</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Level</th>
						<th>Foto</th>
						<th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no = 1;
                    $sql = $koneksi->query("select * from tb_pengguna");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['nama'] ?></td>
                            <td><?php echo $data['level'] ?></td>
							<td><img src="gambar/<?php echo $data['foto'] ?>" width="50" height="50" /></td>
							<td>
								<a style="<?php if($data['username'] == 'admin' || $data['username'] == 'kasir' ){echo 'cursor: not-allowed;text-decoration:none;opacity: 0.5;pointer-events: none';}?>" href="?page=pengguna&aksi=ubah&id=<?php echo $data['id'] ?>" class="btn btn-success">Edit</a> || 
								<a style="<?php if($data['username'] == 'admin' || $data['username'] == 'kasir' ){echo 'cursor: not-allowed;text-decoration:none;opacity: 0.5;pointer-events: none';}?>" onclick="return confirm('Data ini akan di hapus')" href="?page=pengguna&aksi=hapus&id=<?php echo $data['id'] ?>" class="btn btn-danger">Hapus</a>
							</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
			<a href="?page=pengguna&aksi=tambah" class="btn btn-primary">Tambah</a>
        </div>
    </div>
</div>