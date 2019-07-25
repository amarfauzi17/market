<?php
	$kode2 = $_GET['id'];
	$sql =  $koneksi->query("select * from tb_pengguna where id='$kode2'");
	$tampil = $sql->fetch_assoc();
	$satuan = $tampil['level'];
?>

<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Edit Data Pengguna</div>
				<br>
				<form method="post" enctype="multipart/form-data">
					<label for="">Username :</label>
					<div class="form-group">
						<input type="text" name="username" class="form-control" value="<?php echo $tampil['username'] ?>" />
					</div>
					<label for="">Nama Pengguna :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" value="<?php echo $tampil['nama'] ?>" />
					</div>
					<!--<label for="">Password : </label>
					<div class="form-group">
						<input type="password" name="pasword" value="" class="form-control" />
					</div>-->
					<label for="">Level : </label>
					<div class="form-group">
						<select name="level" class="form-control show-tick">
							<option value="admin" <?php if($satuan == 'admin'){ echo "selected";}?> >Admin</option>
							<option value="kasir" <?php if($satuan == 'kasir'){ echo "selected";}?> >Kasir</option>
						</select>
					</div>
					<label for="">Foto : </label>
					<div class="form-group">
						<img src="gambar/<?php echo $tampil['foto'] ?>" alt="<?php echo $tampil['foto'] ?>" height=50 width=50>
					</div>
					<label for="">Ganti Foto : </label>
					<div class="form-group">
						<input style="height:100%" type="file" name="foto" class="form-control"/>
					</div>
					
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</form>
				<?php 
					if(isset($_POST['simpan'])){
						$username = $_POST['username'];
						$nama = $_POST['nama'];
						$level = $_POST['level'];	
						
						$foto= $_FILES['foto']['name'];
						$lokasi = $_FILES['foto']['tmp_name'];
						
						if(!empty($lokasi)){
							$upload = move_uploaded_file($lokasi,"gambar/".$foto);
							$sql2 = $koneksi->query("update tb_pengguna set username='$username', nama='$nama', level='$level', foto='$foto' where id='$kode2'");
						}else{
							$sql2 = $koneksi->query("update tb_pengguna set username='$username', nama='$nama', level='$level' where id='$kode2'");
						}
						
						if($sql2){
							?> 
								<script type="text/javascript">
									alert('Data Berhasil di Ubah');
									window.location.href = '?page=pengguna';
								</script>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>