<?php 
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

$koneksi = new mysqli("localhost","root","","appmarket");

if($_SESSION['admin']){
	header("location:index.php");
}else{
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>App Market - Login</title>
    <!-- Bootstrap core CSS-->
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="asset/css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" class="form-control" placeholder="Username" />
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" class="form-control" placeholder="Password" />
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
          </form>
        </div>
      </div>
	  <br>
	  <br>
	  <p style="text-align:center;color:white;">Level : admin <br>Username : admin , Password: admin</p>
	  <p style="text-align:center;color:white;">Level : kasir <br>Username : kasir , Password: kasir</p>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>


<?php 

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password1 = md5($_POST['password']);
	$password = strfilter($password1);
	$sql = $koneksi->query("select * from tb_pengguna where username='$username' and password='$password'");
	$success = $sql->num_rows;
	$data = $sql->fetch_assoc();
	if($success >= 1){
		session_start();
		if($data['level'] == 'admin'){
			$_SESSION['admin'] = $data[id];
			header('location:index.php');
		}else{
			session_start();
			if($data['level'] == 'kasir'){
				$_SESSION['kasir'] = $data[id];
				header('location:index.php');
			}
		}
	}else{
		?> 
			<script type="text/javascript">
				alert('Login Gagal');
				window.location.href = 'login.php';
			</script>
		<?php
	}
}
}
function strfilter($input){
    $input=trim($input);
    $input=strip_tags($input);
    $input=nl2br($input);
    $input=addslashes($input);
    $input=stripslashes($input);
    $input=str_ireplace("'", "%", $input);
    $input=str_ireplace( "''", '%', $input );
    $input=str_ireplace( '""', '%', $input );
    $query = preg_replace( '|(?<!%)%s|', "'%s'", $input );
    $input=htmlentities($input, ENT_QUOTES);
    $input=ltrim($input);
    $input=rtrim($input);
    return $input;
}
?>
