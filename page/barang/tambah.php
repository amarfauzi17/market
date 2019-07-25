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
<div class="card-body">
	<div class="form-group">
		<div class="form-row">
			<div class="col-md-8">
				<div class="card-header" style="text-align:center">Input Data</div>
				<br>
				<form method="post">
					<label for="">Barcode :</label>
					<div class="form-group">
						<input type="text" name="kode" class="form-control" placeholder="Barcode Barang">
					</div>
					<label for="">Nama Barang :</label>
					<div class="form-group">
						<input type="text" name="nama" class="form-control" placeholder="Nama Barang">
					</div>
					<label for="">Satuan : </label>
					<div class="form-group">
						<select name="satuan" class="form-control show-tick">
							<option value=""><-- PILIH SATUAN --></option>
							<option value="lusin">Lusin</option>
							<option value="pack">Pack</option>
							<option value="pcs">PCS</option>
						</select>
					</div>
					<label for="">Stok : </label>
					<div class="form-group">
						<input type="number" name="stock" class="form-control" placeholder="Stok Barang"/>
					</div>
					<label for="">Harga Beli : </label>
					<div class="form-group">
						<input type="number" name="hbeli" id="h_beli" onkeyup="sum()" class="form-control" placeholder="Harga Beli" />
					</div>
					<label for="">Harga Jual: </label>
					<div class="form-group">
						<input type="number" name="hjual" id="h_jual" onkeyup="sum()" class="form-control" placeholder="Harga Jual" />
					</div>	
					<label for="">Profit : </label>
					<div class="form-group">
						<input type="number" name="profit" id="h_profit" readonly="" value="0" class="form-control">
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
						$sql = $koneksi->query("insert into tb_barang values ('$kode','$nama','$satuan','$hbeli','$stock','$hjual','$profit')");
						if($sql){
							?> 
								<script type="text/javascript">
									alert('Data Berhasil di Tambah');
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