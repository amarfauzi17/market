<?php
	
	$jumlah = $_GET['jumlah'];
	$id = $_GET['id'];
	$kode_pj = $_GET['kode_pj'];
	$harga_jual = $_GET['harga_jual'];
	$kode_b = $_GET['kode_b'];
	
	$sql1 = $koneksi->query("delete from tb_penjualan where id='$id'");
	$sql2 = $koneksi->query("update tb_barang set stock=(stock+$jumlah) where kode_barcode='$kode_b'");
		
	if($sql1 || $sql2 || $sql3){
		?>
		<script>
			window.location.href="?page=penjualan&kodepj=<?php echo $kode_pj ?>";
		</script>
		<?php
	}

?>