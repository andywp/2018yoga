<?php session_start();
$error='';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISTEM INFORMASI Manajemen Informasi Bimbingan Belajar</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="asset/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="asset/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="asset/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<?php
include 'config/db.php';
include 'config/function.php';
!empty($_GET['page'])?$error=alert('error','Silahkan Login terlebih dahulu'):'';


if (isset($_POST["login"])) {
	if(empty($_POST['username'])){
		$error=alert('error','login salah');
	  }
	  elseif(empty($_POST['password'])){
		$error=alert('error','login salah');
	  }else{
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		$query="select * from admin where nama_admin = '".$username."' and pass_admin='".$password."' ";
		
		$login=$system->db->execute($query);
		if($login->recordCount()>0){
			$user=$system->db->getRow($query);
			/* if($user['bagian'] == 'manager'){ */
				$_SESSION['id_admin']=$user['id_admin'];
				$_SESSION['username']=$user['nama_admin'];
				$_SESSION['level']=$user['level'];
				header("Location:index_admin.html");
		}else{
			$query="select * from siswa where username= '".$username."' and password='".$password."' ";
			$login=$system->db->execute($query);
			if($login->recordCount()>0){
				$user=$system->db->getRow($query);
				$_SESSION['id_admin']=$user['id_siswa'];
				$_SESSION['username']=$user['username'];
				$_SESSION['level']='siswa';
				header("Location:index_admin.html");

			}else{
				$query="select * from tentor where tentor_username= '".$username."' and tentor_password='".$password."' ";
				$login=$system->db->execute($query);
				if($login->recordCount()>0){
					$user=$system->db->getRow($query);
					$_SESSION['id_admin']=$user['tentor_id'];
					$_SESSION['username']=$user['tentor_username'];
					$_SESSION['level']='tentor';
					header("Location:index_admin.html");
				}else{
					$error=alert('error','login salah');
				}
				
			}
		}
	}
}

if(isset($_POST['simpan'])){
	
	/* adodb_pr($_POST); */
	$fild='';
	foreach($_POST as $k=>$v){
		if($k!='simpan'){
			
			$v=($k=='password')?md5($v):$v;
			
		$fild.=$k.'="'.$v.'",';
		}
	}
	$query="insert into siswa set ".$fild."id_siswa=''";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil simpan silahkan login untuk proses selanjutnya');
		$_POST=array();
		
	}else{
		$error=alert('error','terjadi kesalahan');
	}
	
	
}







?>
<style>
	.login-logo span {
		font-size: 20px;
	}
	.login-logo {
    line-height: 1;
}
</style>


<div class="login-box">
  <div class="login-logo">
	
    <a href="index.html"><b>SISTEM INFORMASI</b> <span class="small">Manajemen Informasi Bimbingan Belajar</span></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
	<?= @$error ?>
    <p class="login-box-msg">Sign in to start your session</p>
	
    <form action="" method="POST">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
		</div>
		<div class="col-xs-6">
		  <button type="button" class="btn btn-info btn-block btn-flat" data-toggle="modal" data-target="#myModal">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	
	
	 <!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <form class="form-horizontal"  role="form" method="POST" enctype="multipart/form-data" action="">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Form Pendaftaran </h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Nama</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" name="nama_siswa"  required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"  >Alamat</label>
				  <div class="col-sm-10">
						<textarea name="alamat" class="form-control" rows="3" placeholder="Enter ..." required="required"></textarea>
				  </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"  >Jenis Kelamin</label>
					 <div class="col-sm-10">
						  <select name="gender" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option value="" >Pilih</option>
							<option value="L">LAKI-LAKI</option>
							<option value="P">PEREMPUAN</option>
						  </select>
					 </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Nama orang tua</label>
				  <div class="col-sm-10">
						<input type="text" class="form-control" name="nama_ortu"  required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"  >Telepon / HP</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" name="no_hp"  required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Email</label>
				  <div class="col-sm-10">
						<input type="email" class="form-control" name="email"  required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" >Username</label>
				  <div class="col-sm-10">
						<input type="text" class="form-control" name="username"  required>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label"  >Password</label>
				  <div class="col-sm-10">
						<input type="password" class="form-control" name="password"  required>
				  </div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" name="simpan" class="btn btn-primary">Daftar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		  </div>
		  </form>
		</div>
	</div>
	
	
	
	

    <!-- /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="asset/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="asset/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
