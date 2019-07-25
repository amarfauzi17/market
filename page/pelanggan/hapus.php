<?php
	$kode2 = $_GET['id'];
	$sql =  $koneksi->query("delete from tb_pelanggan where kode_pelanggan='$kode2'");

	if($sql){
		?> 
		<script type="text/javascript">
			alert('Data Berhasil di Hapus');
			window.location.href = '?page=pelanggan';
		</script>
		<?php
	}
					