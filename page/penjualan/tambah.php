<?php
	$id = $_GET['id'];
	$kode_pj = $_GET['kode_pj'];
	$harga_jual = $_GET['harga_jual'];
	$kode_b = $_GET['kode_b'];
	$sql2 = $koneksi->query("select * from tb_barang where kode_barcode='$kode_b'");
	while($data_barang2 = $sql2->fetch_assoc()){
		$sisa = $data_barang2['stock'];
		if($sisa == 0){
			?>
				<script type="text/javascript">
					alert('Stock Tidak Tersedia Sebanyak Itu');
					window.location.href = '?page=penjualan&kodepj=<?php echo $kode_pj; ?>';
				</script>
			<?php
		}else{
	
			$sql1 = $koneksi->query("update tb_penjualan set jumlah=(jumlah+1) where id='$id'");
			$sql2 = $koneksi->query("update tb_penjualan set total=(total+$harga_jual) where id='$id'");
			$sql3 = $koneksi->query("update tb_barang set stock=(stock-1) where kode_barcode='$kode_b'");
			
			if($sql1 || $sql2 || $sql3){
				?>
				<script>
					window.location.href="?page=penjualan&kodepj=<?php echo $kode_pj ?>";
				</script>
				<?php
			}
		}
	}
?>