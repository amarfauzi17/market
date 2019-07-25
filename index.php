<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include('kodepj.php');
$koneksi = new mysqli("localhost","root","","appmarket");
$active = $_GET['page'];
if($_SESSION['admin'] || $_SESSION['kasir']){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>App Market</title>
        <!-- Bootstrap core CSS-->
        <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="asset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="asset/css/sb-admin.css" rel="stylesheet">
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="">App Market</a>
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>
  
			<?php 
			if($_SESSION['admin']){
				$user = $_SESSION['admin'];
			}elseif($_SESSION['kasir']){
				$user = $_SESSION['kasir'];
			}
			$sql = $koneksi->query("select * from tb_pengguna where id='$user'");
			$data = $sql->fetch_assoc();
			?>
			
		</nav>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav"><br>
			<div class="text-center">
				<div class="image">
					<img src="gambar/<?php echo $data['foto'] ?>" alt="<?php echo $data['username'] ?>" width='auto' height=100/>
				</div>
				<div class="user-info">
					<p style="color:white" ><?php echo $data['username'] ?> <br> Anda login sebagai <?php echo $data['level'] ?></p>					
				</div>
			</div>
                <li class="nav-item <?php if($active=='dashboard'){echo 'active';} ?> ">
                    <a class="nav-link" href="?page=dashboard">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
				<li class="nav-item <?php if($active=='penjualan'){echo 'active';}?>">
                    <a class="nav-link" href="?page=penjualan&kodepj=<?php echo $kodepj ?>">
                        <i class="fas fa-fw fa-store"></i>
                    <span>Cashier</span></a>
                </li>
				<?php if($_SESSION['admin']){ ?>   
                <li class="nav-item <?php if($active=='barang'){echo 'active';} ?>">
                    <a class="nav-link" href="?page=barang">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Barang</span></a>
                </li>
                <li class="nav-item <?php if($active=='pelanggan'){echo 'active';} ?>">
                    <a class="nav-link" href="?page=pelanggan">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Pelanggan</span></a>
                </li>
				<li class="nav-item <?php if($active=='pengguna'){echo 'active';} ?>">
                    <a class="nav-link" href="?page=pengguna">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Pengguna</span></a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#smallModal">
                        <i class="fas fa-fw fa-book"></i>
                        <span>Laporan Penjualan</span></a>
                </li>
				<?php } ?>
				<li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
						<span>Logout</span>
					</a>
                </li>
            </ul>
				
            <div id="content-wrapper">
                <!-- konten -->
                <?php
                $page = $_GET['page'];
                $aksi = $_GET['aksi'];
                if ($page == 'dashboard') {
                    if ($aksi == '') {
                        include 'page/dashboard.php';
                    }
                }
                if ($page == 'barang') {
                    if ($aksi == '') {
                        include 'page/barang/barang.php';
                    }
					if ($aksi == 'tambah') {
                        include 'page/barang/tambah.php';
                    }
					if ($aksi == 'ubah') {
                        include 'page/barang/ubah.php';
                    }
					if ($aksi == 'hapus') {
                        include 'page/barang/hapus.php';
                    }
                }
                if ($page == 'pelanggan') {
                    if ($aksi == '') {
                        include 'page/pelanggan/pelanggan.php';
                    }
					if ($aksi == 'ubah') {
                        include 'page/pelanggan/ubah.php';
                    }
					if ($aksi == 'tambah') {
                        include 'page/pelanggan/tambah.php';
                    }
					if ($aksi == 'hapus') {
                        include 'page/pelanggan/hapus.php';
                    }
                }
				if ($page == 'pengguna') {
                    if ($aksi == '') {
                        include 'page/pengguna/pengguna.php';
                    }
					if ($aksi == 'ubah') {
                        include 'page/pengguna/ubah.php';
                    }
					if ($aksi == 'tambah') {
                        include 'page/pengguna/tambah.php';
                    }
					if ($aksi == 'hapus') {
                        include 'page/pengguna/hapus.php';
                    }					
                }if ($page == 'penjualan') {
                    if ($aksi == '') {
                        include 'page/penjualan/penjualan.php';
                    }
					if ($aksi == 'kurang') {
                        include 'page/penjualan/kurang.php';
                    }
					if ($aksi == 'tambah') {
                        include 'page/penjualan/tambah.php';
                    }
					if ($aksi == 'hapus') {
                        include 'page/penjualan/hapus.php';
                    }
				}if ($page == '') {
					include 'page/dashboard.php';
                }
                ?>
                <footer class="sticky-footer">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright © Amar Fauzi 2018</span>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="asset/vendor/jquery/jquery.min.js"></script>
        <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Page level plugin JavaScript-->
        <script src="asset/vendor/chart.js/Chart.min.js"></script>
        <script src="asset/vendor/datatables/jquery.dataTables.js"></script>
        <script src="asset/vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="asset/js/sb-admin.min.js"></script>
        <!-- Demo scripts for this page-->
        <script src="asset/js/demo/datatables-demo.js"></script>
        <script src="asset/js/demo/chart-area-demo.js"></script>
    </body>
</html>

<?php 
}else{
	header("location:login.php");
}
?>
 <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="text-align:center" id="exampleModalLabel">Laporan Penjualan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
                </button>
            </div>
			<form method="POST" action="page/penjualan/laporan.php" target="_blank">
				<div class="modal-body">
						<label for="">Tanggal Awal</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tgl_awal" class="form-control" />
							</div>
						</div>
						<label for="">Tanggal Akhir</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="tgl_akhir" class="form-control" />
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" target="_blank" class="btn btn-primary">Cetak</button>
					<button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
        </div>
    </div>
</div>
        