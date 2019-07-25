<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	$koneksi = new mysqli("localhost","root","","appmarket");
?>
<style>
	@media print{
		input.noPrint{
			display:none;
		}
	}
</style>
<table border='1' width="100%" style="border-collapse:collapse;">
	<h1 style="text-align:center">Laporan Data Barang</h1>
	<br>
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Kode Barcode</th>
			<th>Nama Barang</th>
			<th>Harga Jual</th>
			<th>Jumlah</th>
			<th>Total</th>
			<th>Profit</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$tgl_awal = $_POST['tgl_awal'];
			$tgl_akhir = $_POST['tgl_akhir'];
			$no=1;
			$sql = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barcode = tb_barang.kode_barcode and tgl_penjualan between '$tgl_awal' and '$tgl_akhir' ");
			while($data = $sql->fetch_assoc()){
				$profit = $data['profit'] * $data['jumlah'];
		?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo date('d F Y',strtotime($data['tgl_penjualan'])); ?></td>
					<td><?php echo $data['kode_barcode']; ?></td>
					<td><?php echo $data['nama_barang']; ?></td>
					<td><?php echo number_format($data['harga_jual']); ?></td>
					<td><?php echo $data['jumlah']; ?></td>
					<td><?php echo number_format($data['total']); ?></td>
					<td><?php echo number_format($data['profit']); ?></td>
				</tr>
		<?php 
			$total_pj = $total_pj+$data['total'];
			$total_pr = $total_pr + $profit;
			} 
		?>
	</tbody>
	<tr>
		<th colspan="6">Total Penjualan & Profit</th>
		<td><b><?php echo number_format($total_pj); ?></b></td>
		<td><b><?php echo number_format($total_pr); ?></b></td>
	</tr>
</table>
<br>
<input type="button" class="noPrint" value="Cetak" onclick="window.print()">