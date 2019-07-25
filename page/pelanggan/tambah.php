<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Input Data</div>
				<br>
				<form method="post">
					<label for="">Nama Pelanggan :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" placeholder="Nama Pelanggan">
					</div>
					<label for="">Alamat :</label>
					<div class="form-group">
						<textarea type="text" name="alamat" class="form-control" placeholder="Alamat"></textarea>				
					</div>
					<label for="">Telpon:</label>
					<div class="form-group">
						<input type="number" name="telpon" class="form-control" placeholder="Nomer Telpon">
					</div>
					<label for="">Email:</label>
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</form>
				<?php 
					if(isset($_POST['simpan'])){
						$nama = $_POST['nama'];
						$alamat= $_POST['alamat'];
						$telpon = $_POST['telpon'];	
						$email= $_POST['email'];
						$sql = $koneksi->query("insert into tb_pelanggan (nama,alamat,telpon,email) values ('$nama','$alamat','$telpon','$email')");
						if($sql){
							?> 
								<script type="text/javascript">
									alert('Data Berhasil di Tambah');
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