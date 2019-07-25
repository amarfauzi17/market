<?php
	$kode2 = $_GET['id'];
	$sql =  $koneksi->query("select * from tb_pelanggan where kode_pelanggan='$kode2'");
	$tampil = $sql->fetch_assoc();
?>

<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Input Data</div>
				<br>
				<form method="post">
					<label for="">Nama Pelanggan :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" value="<?php echo $tampil['nama'] ?>" placeholder="Nama Pelanggan">
					</div>
					<label for="">Alamat :</label>
					<div class="form-group">
						<textarea type="text" name="alamat" class="form-control"><?php echo $tampil['alamat'] ?></textarea>
					</div>
					<label for="">Telpon : </label>
					<div class="form-group">
						<input type="number" name="telpon" value="<?php echo $tampil['telpon'] ?>" class="form-control" placeholder="Telpon"/>
					</div>
					<label for="">Email : </label>
					<div class="form-group">
						<input type="email" name="email" value="<?php echo $tampil['email'] ?>" class="form-control" placeholder="Email" />
					</div>
					
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</form>
				<?php 
					if(isset($_POST['simpan'])){
						$nama = $_POST['nama'];
						$alamat= $_POST['alamat'];
						$telpon = $_POST['telpon'];	
						$email= $_POST['email'];
						$sql2 = $koneksi->query("update tb_pelanggan set nama='$nama', alamat='$alamat', telpon='$telpon', email='$email' where kode_pelanggan='$kode2'");
						if($sql2){
							?> 
								<script type="text/javascript">
									alert('Data Berhasil di Ubah');
									window.location.href = '?page=pelanggan';
								</script>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>