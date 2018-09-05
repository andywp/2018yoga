<?php
include 'session.php';
include 'config/db.php';
include 'config/function.php';
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
  <link rel="stylesheet" href="plugins/custom/css/datepicker.css">
  <link rel="stylesheet" href="plugins/custom/css/bootstrap-timepicker.css">
  <link rel="stylesheet" href="plugins/custom/css/daterangepicker.css">
  <link rel="stylesheet" href="plugins/custom/css/bootstrap-datetimepicker.css">

   <!-- Select2 -->
  <link rel="stylesheet" href="asset/select2/dist/css/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="asset/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="asset/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="asset/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="asset/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
 
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<style>
		.main-header .title-site {
			float: left;
			background-color: transparent;
			background-image: none;
			padding: 10px;
			color: #fff;
		}
		a.title-site {
			color: #fff;
			padding: 15px 15px;
			font-size: 20px;
			/* margin-top: 20px; */
		}
	</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <header class="main-header">
    <!-- Logo -->
     <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
     
	  <a href="index_admin.html" target="_blank" class="title-site">
		 <span class="logo-lg">SISTEM INFORMASI Manajemen Informasi Bimbingan Belajar</span>
	  </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <i class="fa  fa-user"></i>
            </a>
            <ul class="dropdown-menu">

              <li class="header"><a href="logout.html">LogOut</a></li>
            </ul>
          </li>
		  
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
		<?php
			if($_SESSION['level']=='admin'){
				include 'menu.php';
			}elseif($_SESSION['level']=='manager'){
				include 'menu.manager.php';
			}elseif($_SESSION['level']=='siswa'){
				include 'menu.siswa.php';
			}elseif($_SESSION['level']=='tentor'){
				include 'menu.tentor.php';
			}

		?>
    </section>
    <!-- /.sidebar -->
  </aside>