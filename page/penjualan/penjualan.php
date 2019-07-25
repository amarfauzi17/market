<?php
	$kode = $_GET['kodepj'];
	$kasir = $data['nama'];
?>
<!-- DataTables Example -->
<div class="body">
	<form method="POST">
		<div class="col-md-2" style="float:left">
			<input type="text" name="kode" class="form-control" readonly="" value="<?php echo $kode ?>"/>
		</div>
		<div class="col-md-2" style="float:left">
			<input type="text" name="barcode" class="form-control" placeholder="Input Barcode" />
		</div>
		<div class="col-md-2" style="float:left">
			<input type="submit" name="simpan" value="Tambahkan" class="btn btn-primary"  />
		</div>
	</form>
</div>
<?php 

if(isset($_POST['simpan'])){
	$date = date('Y-m-d');
	$kdpj = $_POST['kode'];
	$barcode = $_POST['barcode'];
	$sql = $koneksi->query("select * from tb_barang where kode_barcode='$barcode'");
	$data_barang = $sql->fetch_assoc();
	$harga_jual = $data_barang['harga_jual'];
	$jumlah = 1;
	$total = $jumlah * $harga_jual;
	$sql2 = $koneksi->query("select * from tb_barang where kode_barcode='$barcode'");
	while($data_barang2 = $sql2->fetch_assoc()){
		$sisa = $data_barang2['stock'];
		if($sisa == 0){
			?>
				<script type="text/javascript">
					alert('Stock Tidak Tersedia');
					window.location.href = '?page=penjualan&kodepj=<?php echo $kode; ?>';
				</script>
			<?php
		}else{
			$koneksi->query("insert into tb_penjualan (kode_penjualan,kode_barcode,jumlah,total,tgl_penjualan) values('$kdpj','$barcode','$jumlah','$total','$date')");
		}
	}
}
?>
<br><br><br>
<form method="POST">
	<div class="col-md-2">
		<label for="">Pelanggan :</label>
		<select name="pelanggan" class="form-control">
			<?php 
				$pelanggansql = $koneksi->query("select * from tb_pelanggan order by nama");
				while($id_pelanggan = $pelanggansql->fetch_assoc()){
					echo "<option value='$id_pelanggan[kode_pelanggan]'>$id_pelanggan[nama]</option>";
				}
			?>
		</select>
	</div>
	<br><br>
    <div class="card-header">
        <i class="fas fa-store"></i>
        Daftar Belanjaan
	</div>
	<div class="card-body">
		<div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
                <thead>
                    <tr>
						<th>NO</th>
                        <th>Kode Barcode</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                    <?php
	                $no = 1;
                    $sql = $koneksi->query("select * from tb_penjualan,tb_barang where tb_penjualan.kode_barcode=tb_barang.kode_barcode AND kode_penjualan='$kode'");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data['kode_barcode'] ?></td>
                            <td><?php echo $data['nama_barang'] ?></td>
                               <td><?php echo $data['harga_jual'] ?></td>
                            <td type="number"><?php echo $data['jumlah'] ?></td>
							<td><?php echo $data['total'] ?></td>
							<td>
								<a href="?page=penjualan&aksi=tambah&id=<?php echo $data['id'] ?>&kode_pj=<?php echo $data['kode_penjualan'] ?>&harga_jual=<?php echo $data['harga_jual']?>&kode_b=<?php echo $data['kode_barcode']?>" title="tambah" class="btn btn-success"><i class="fas fa-fw fa-plus"></i></a> 
								<a href="?page=penjualan&aksi=kurang&id=<?php echo $data['id'] ?>&kode_pj=<?php echo $data['kode_penjualan'] ?>&harga_jual=<?php echo $data['harga_jual']?>&kode_b=<?php echo $data['kode_barcode']?>" title="kurang" class="btn btn-success"><i class="fas fa-fw fa-minus"></i></a> 
								<a onclick="return confirm('Data ini akan di hapus')" href="?page=penjualan&aksi=hapus&id=<?php echo $data['id'] ?>&kode_pj=<?php echo $data['kode_penjualan'] ?>&harga_jual=<?php echo $data['harga_jual']?>&kode_b=<?php echo $data['kode_barcode']?>&jumlah=<?php echo $data['jumlah'] ?>" class="btn btn-danger"><i class="fas fa-fw fa-times"></i></i></a>
							</td>
                        </tr>
                    <?php  
						$total_bayar = $total_bayar + $data['total'];
						}
					?>

                </tbody>
				<tr>
					<th colspan="5" style="text-align:right;">Total</th>
					<th><input type="number" name="total_bayar" id="total_bayar" onkeyup="hitung();" value="<?php echo $total_bayar ?>" readonly="" class="form-control"/></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:right;">Diskon</th>
					<th><input type="number" name="diskon" id="diskon" onkeyup="hitung();" class="form-control"/></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:right;">Potongan Diskon</th>
					<th><input type="number" name="potongan" id="potongan" onkeyup="hitung();" readonly="" class="form-control"/></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:right;">Sub Total</th>
					<th><input type="number" name="sub_total" id="sub_total" onkeyup="hitung();" readonly="" class="form-control"/></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:right;">Bayar</th>
					<th><input type="number" name="bayar" id="bayar" onkeyup="hitung();" class="form-control"/></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:right;">Kembali</th>
					<th><input type="number" name="kembali" id="kembali" onkeyup="hitung();" readonly="" class="form-control"/>
					
					</th>				
					<th colspan="6"><input type="submit" class="btn btn-success" name="simpan_pj" value="Simpan"/>&nbsp&nbsp <input type="submit" value="Cetak Struk" class="btn btn-primary" onclick="window.open('page/penjualan/cetak.php?kode_pjl=<?php echo $kode ?>&kasir=<?php echo $kasir ?>','mywindow','width=400px,height=600px,left=300px;top=100px;')"></th>
				</tr>
				
            </table>
			
        </div>
    </div>
	</form>
	<?php
	if(isset($_POST['simpan_pj'])){
		$pelanggan = $_POST['pelanggan'];
		$total_bayar = $_POST['total_bayar'];
		$diskon = $_POST['diskon'];
		$potongan = $_POST['potongan'];
		$sub_total = $_POST['sub_total'];
		$bayar = $_POST['bayar'];
		$kembali = $_POST['kembali'];
		
		$koneksi->query("insert into tb_penjualan_detail(kode_penjualan,bayar,kembali,diskon,potongan,total_bayar) values ('$kode','$total_bayar','$kembali','$diskon','$potongan','$sub_total')");
		$koneksi->query("update tb_penjualan set id_pelanggan='$pelanggan' where kode_penjualan='$kode'");
		?>
		<script>
			window.open('page/penjualan/cetak.php?kode_pjl=<?php echo $kode ?>&kasir=<?php echo $kasir ?>','mywindow','width=400px,height=600px,left=300px;top=100px;');
		</script>
	<?php
	}
	?>
	<script type="text/javascript">
		function hitung(){
			var total_bayar = document.getElementById('total_bayar').value;
			var diskon = document.getElementById('diskon').value;
			var bayar = document.getElementById('bayar').value;
			var diskon_pot = parseInt(total_bayar) * parseInt(diskon)/ parseInt(100);
			if( !isNaN(diskon_pot)){
				var potongan = document.getElementById('potongan').value = diskon_pot ;
			}
			var sub_total = parseInt(total_bayar) - parseInt(potongan);
			if( !isNaN(sub_total)){
				var sub_total = document.getElementById('sub_total').value = sub_total ;
			}
			var kembali = parseInt(bayar) - parseInt(sub_total);
			if( !isNaN(kembali)){
				var kembali = document.getElementById('kembali').value = kembali;
			}
		}
	</script>

