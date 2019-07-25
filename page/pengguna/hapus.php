<?php
	$kode2 = $_GET['id'];
	$sql =  $koneksi->query("delete from tb_pengguna where id='$kode2'");

	if($sql){
		?> 
		<script type="text/javascript">
			alert('Pengguna Berhasil di Hapus');
			window.location.href = '?page=pengguna';
		</script>
		<?php
	}
					