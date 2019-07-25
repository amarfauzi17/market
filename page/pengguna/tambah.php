<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Input Data Pengguna</div>
				<br>
				<form method="post" enctype="multipart/form-data">
					<label for="">Username:</label>
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="Username">
					</div>
					<label for="">Nama Pengguna :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan">				
					</div>
					<label for="">Password:</label>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<label for="">Level : </label>
					<div class="form-group">
						<select name="level" class="form-control show-tick">
							<option value="admin">Admin</option>
							<option value="kasir">Kasir</option>
						</select>
					</div>
					<label for="">Foto : </label>
					<div class="form-group">
						<input style="height:100%" type="file" name="foto" class="form-control"/>
					</div>
					
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</form>
				<?php 
					if(isset($_POST['simpan'])){
						$username = $_POST['username'];
						$nama = $_POST['nama'];
						$password = md5($_POST['password']);
						$level = $_POST['level'];	
						
						$foto= $_FILES['foto']['name'];
						$lokasi = $_FILES['foto']['tmp_name'];
						$upload = move_uploaded_file($lokasi,"gambar/".$foto);
						
						//$if($upload){
						
							$sql = $koneksi->query("insert into tb_pengguna (username,nama,password,level,foto) values ('$username','$nama','$password','$level','$foto')");
							if($sql){
								?> 
									<script type="text/javascript">
										alert('Data Berhasil di Tambah');
										window.location.href = '?page=pengguna';
									</script>
								<?php
							//}
						}
					}
				?>
			</div>
		</div>
	</div>
</div>