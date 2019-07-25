<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$koneksi = new mysqli("localhost","root","","appmarket");
	$tgl = date('Y-m-d');
	
	$sql = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barcode = tb_barang.kode_barcode and tgl_penjualan='$tgl'");
	while($data = $sql->fetch_assoc()){
		$profit = $data['profit'] * $data['jumlah'];
		$total_pj = $total_pj+$data['total'];
		$total_pr = $total_pr+$profit;
	}
	$sql2 = $koneksi->query("SELECT COUNT(*) AS count FROM tb_barang");
	$jml_barang = $sql2->fetch_assoc();
	$sql3 = $koneksi->query("SELECT SUM(stock) AS stock_barang FROM tb_barang");
	$stock_barang = $sql3->fetch_assoc();

	for($i=5; $i>= 0; $i--){
		$tgl_profit = date('Y-m-d', strtotime("-$i day", strtotime(date("Y-m-d"))));
		$sql4 = $koneksi->query("select sum(tb_barang.profit) AS sum_profit from tb_penjualan, tb_barang where tb_penjualan.kode_barcode = tb_barang.kode_barcode AND tb_penjualan.tgl_penjualan='$tgl_profit' ORDER BY tb_penjualan.tgl_penjualan");
		$profit_hari = $sql4->fetch_assoc();
		$profit_chart[] = $profit_hari['sum_profit'];
		$bc[] =$tgl_profit;
	}
	//$sql_tgl_chart = $koneksi->query("SELECT DISTINCT tgl_penjualan FROM `tb_penjualan` WHERE `tgl_penjualan` BETWEEN '2018-11-01' AND '2018-11-5' LIMIT 7");
	print_r($bc);	
	print_r($profit_chart);


?>
