<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$kasir = $_GET['kasir'];
	$kode_pj = 	$_GET['kode_pjl'];
	$koneksi = new mysqli("localhost","root","","appmarket");
?>

<h4 style="text-align:center">Daftar Belanjaan</h4>
<table>
	<tr>
		<td>Toko App Market</td>
	</tr>
	<tr>
		<td>Jln Tol 12 kecamatan siliwangi</td>
	</tr>
</table>
<hr>
<table>
	<?php 
		$sql = $koneksi->query("select * from tb_penjualan, tb_pelanggan where tb_penjualan.id_pelanggan = tb_pelanggan.kode_pelanggan and kode_penjualan='$kode_pj'");
		$data = $sql->fetch_assoc();
	?>
	<tr>
		<td>Kode Penjualan &nbsp&nbsp</td>
		<td>: &nbsp&nbsp <?php echo $data['kode_penjualan']; ?></td>
	</tr>
	<tr>
		<td>Tanggal &nbsp&nbsp</td>
		<td>: &nbsp&nbsp <?php echo $data['tgl_penjualan']; ?></td>
	</tr>
	<tr>
		<td>Kasir &nbsp&nbsp</td>
		<td>: &nbsp&nbsp <?php echo $kasir; ?></td>
	</tr>
</table>
<hr>
<table>
	<?php 
		$sql2 = $koneksi->query("select * from tb_penjualan, tb_penjualan_detail, tb_barang where tb_penjualan .kode_penjualan = tb_penjualan_detail.kode_penjualan and tb_penjualan.kode_barcode = tb_barang.kode_barcode and tb_penjualan.kode_penjualan = '$kode_pj'");
		while($data2 = $sql2->fetch_assoc()){
	?>
	<tr>
		<td><?php echo $data2['nama_barang'].'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp';?></td>
		<td><?php echo number_format($data2['harga_jual']).',-'.'&nbsp'.'&nbsp'.'X'.'&nbsp'.'&nbsp'.$data2['jumlah'].'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'.'&nbsp'; ?></td>
		<td><?php echo number_format($data2['total']).',-'; ?></td>
	</tr>
	<?php 
	
	$diskon = $data2['diskon'];
	$potongan = $data2['potongan'];
	$bayar = $data2['bayar'];
	$kembali = $data2['kembali'];
	$total_bayar = $data2['total_bayar'];
	$jml_total = $jml_total + $data2['total'];
	
	} ?>
	<tr>
		<td><hr></td>
	</tr>
	<tr>
		<th colspan="2">Total</th>
		<td>: &nbsp&nbsp <?php echo $jml_total ?></td>
	</tr>
	<tr>
		<th colspan="2">Diskon</th>
		<td>: &nbsp&nbsp <?php echo $diskon ?>%</td>
	</tr>
	<tr>
		<th colspan="2">Potongan Diskon</th>
		<td>: &nbsp&nbsp <?php echo number_format($potongan) ?></td>
	</tr>
	<tr>
		<th colspan="2">Bayar</th>
		<td>: &nbsp&nbsp <?php echo number_format($bayar) ?></td>
	</tr>
	<tr>
		<th colspan="2">Kembali</th>
		<td>: &nbsp&nbsp <?php echo number_format($kembali) ?></td>
	</tr>
</table>
</table>
<hr>
<table>
	<tr>
		<th style="text-align:center">Barang yang sudah di beli tidak dapat di kembalikan lagi</th>
	</tr>
</table>
<br>
<input type="submit" class="btn btn-primary" onclick="window.print()" value="Print"/>