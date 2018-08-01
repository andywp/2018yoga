<?php include'header.php'; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	<?php
		if($_SESSION['level']=='admin'){
			$akses=' Admin';
		}elseif($_SESSION['level']=='manager'){
			$akses=' Direktur';
		}elseif($_SESSION['level']=='siswa'){
			$akses=' Siswa';
		}elseif($_SESSION['level']=='tentor'){
			$akses=' Tentor';
		}
	
	?>
    <!-- Main content -->
    <section class="content">
		<div class="alert alert-info alert-dismissible" style="margin-top:70px;" >
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-info"></i> Selamat Datang!</h4>
			<strong><?= $_SESSION['username'] ?> </strong> anda memasuki halaman <?= $akses ?>
		  </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'footer.php'; ?>