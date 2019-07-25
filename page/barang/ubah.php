<script type="text/javascript">
	function sum(){
		var h_beli = document.getElementById("h_beli").value;
		var h_jual = document.getElementById("h_jual").value;
		var result = parseInt(h_jual) - parseInt(h_beli);
		if(!isNaN(result)){
			document.getElementById('h_profit').value = result;
		}
	}
</script>
<?php
	$kode2 = $_GET['id'];
	$sql =  $koneksi->query("select * from tb_barang where kode_barcode='$kode2'");
	$tampil = $sql->fetch_assoc();
	$satuan = $tampil['satuan'];
?>

<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Input Data</div>
				<br>
				<form method="post">
					<label for="">Barcode :</label>
					<div class="form-group">
						<input type="text" name="kode" class="form-control" value="<?php echo $tampil['kode_barcode'] ?>" placeholder="Barcode Barang">
					</div>
					<label for="">Nama Barang :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" value="<?php echo $tampil['nama_barang'] ?>" placeholder="Nama Barang">
					</div>
					<label for="">Satuan : </label>
					<div class="form-group">
						<select name="satuan" class="form-control show-tick">
							<option value="lusin" <?php if($satuan == 'lusin'){ echo "selected";} ?>>Lusin</option>
							<option value="pack" <?php if($satuan == 'pack'){ echo "selected";} ?>>Pack</option>
							<option value="pcs" <?php if($satuan == 'pcs'){ echo "selected";} ?>>PCS</option>
						</select>
					</div>
					<label for="">Stok : </label>
					<div class="form-group">
						<input type="number" name="stock" value="<?php echo $tampil['stock'] ?>" class="form-control" placeholder="Stok Barang"/>
					</div>
					<label for="">Harga Beli : </label>
					<div class="form-group">
						<input type="number" name="hbeli" id="h_beli" value="<?php echo $tampil['harga_beli'] ?>" onkeyup="sum()" class="form-control" placeholder="Harga Beli" />
					</div>
					<label for="">Harga Jual: </label>
					<div class="form-group">
						<input type="number" name="hjual" id="h_jual" value="<?php echo $tampil['harga_jual'] ?>" onkeyup="sum()" class="form-control" placeholder="Harga Jual" />
					</div>	
					<label for="">Profit : </label>
					<div class="form-group">
						<input type="number" name="profit" id="h_profit" readonly="" value="<?php echo $tampil['profit'] ?>" class="form-control">
					</div>					
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</form>
				<?php 
					if(isset($_POST['simpan'])){
						$kode = $_POST['kode'];
						$nama = $_POST['nama'];
						$satuan= $_POST['satuan'];
						$stock = $_POST['stock'];	
						$hbeli = $_POST['hbeli'];
						$hjual = $_POST['hjual'];
						$profit = $_POST['profit'];
						$sql2 = $koneksi->query("update tb_barang set kode_barcode='$kode', nama_barang='$nama', satuan='$satuan', harga_beli='$hbeli', stock='$stock', harga_jual='$hjual', profit='$profit' where kode_barcode='$kode2'");
						if($sql2){
							?> 
								<script type="text/javascript">
									alert('Data Berhasil di Ubah');
									window.location.href = '?page=barang';
								</script>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>