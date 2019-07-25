<?php 
	$tgl = date('Y-m-d');
	$sql = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barcode = tb_barang.kode_barcode and tgl_penjualan='$tgl'");
	while($data = $sql->fetch_assoc()){
		$profit = $data['profit'] * $data['jumlah'];
		$total_pj = $total_pj + $data['total'];
		$total_pr = $total_pr+$profit;
	}
	$sql2 = $koneksi->query("SELECT COUNT(*) AS count FROM tb_barang");
	$jml_barang = $sql2->fetch_assoc();
	$sql3 = $koneksi->query("SELECT SUM(stock) AS stock_barang FROM tb_barang");
	$stock_barang = $sql3->fetch_assoc();

	for($i=6; $i>= 0; $i--){
		$tgl_profit = date('Y-m-d', strtotime("-$i day", strtotime(date("Y-m-d"))));
		$sql4 = $koneksi->query("select * from tb_penjualan, tb_barang where tb_penjualan.kode_barcode = tb_barang.kode_barcode and tgl_penjualan='$tgl_profit'");
		$profit_hari = $sql4->fetch_assoc();
		$profit_chart[] = $profit_hari['profit'] * $profit_hari['jumlah'];
		$tgl_chart[] = $tgl_profit;
	}
		
?>

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Selamat Datang</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-archive"></i>
                    </div>
                    <div class="mr-5">Jenis Barang : <?php echo $jml_barang['count']; ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?page=barang">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-dollar-sign"></i>
                    </div>
                    <div class="mr-5">Rp <?php echo number_format($total_pr); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Profit hari ini</span>
                 </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-shopping-cart"></i>
                    </div>
                    <div class="mr-5">Rp <?php echo number_format($total_pj); ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                    <span class="float-left">Penjualan hari ini</span>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                    <div class="card-body-icon">
                        <i class="fas fa-fw fa-sync-alt"></i>
                    </div>
                    <div class="mr-5">Stok Barang : <?php echo $stock_barang['stock_barang']; ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="index.php?page=barang">
                    <span class="float-left">View Details</span>
                    <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Area Chart Example-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Profit chart selama 1 minggu terakhir</div>
        <div class="card-body">
            <canvas id="myAreaChartProfit" width="100%" height="30"></canvas>
        </div>
    </div>
</div>
<script>
var ctx = document.getElementById("myAreaChartProfit").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php foreach($tgl_chart as $tc){echo '"' . $tc . '",';} ?>],
        datasets: [{
            label: '# of Votes',
            data: [<?php foreach($profit_chart as $pc){echo '"' . $pc . '",';} ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
