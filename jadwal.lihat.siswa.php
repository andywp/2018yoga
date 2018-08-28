<?php 
include'header.php'; 
$error='';

?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>Form Input Jadwal </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	  </ol>
	</section>


<section class="content">
	 <!-- general form elements -->
	  <div class="box box-primary">
		<div class="box-header with-border">
		  <h3 class="box-title">Jadwal Bibingan Belajar</h3>
		    <div class="box-tools">
                <a href="pengaturan.jadwal.html" class="btn btn-block btn-danger"><i class="fa fa-arrow-left"> Tambah </i></a>
              </div>
		</div>
		<!-- /.box-header -->
			<!-- form start -->
	  </div>
	 <?php
	$html='';
	
	$detJadwal=$system->db->getRow('select * from jadwal where jadwal_id="'.$_GET['id'].'"');
	/* adodb_pr($detJadwal); */
	$data=$system->db->getRow("select * from siswa where id_siswa='".$_SESSION['id_admin']."'");	
	$hari=array(
		'Senin',
		'Selasa',
		'Rabu',
		'Kamis',
		'Jumat',
		'Sabtu'
	);
	$html='';
	$no=1;
	foreach($hari as $k=>$v){
		$jadwalMengapu=$system->db->getAll('select a.*, b.tentor_nama, c.mapel from detail_jadwal as a, tentor as b , mapel as c, mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and d.mapel_id=c.mapel_id and a.jadwal_id="'.$_GET['id'].'" and a.hari="'.$v.'" ');
		$tabelList='';
		$i=1;
		foreach($jadwalMengapu as $r){
			$tabelList.='
						<tr>
							<td>'.$i.'</td>
							<td>'.$r['jam'].'</td>
							<td>'.$r['program'].'</td>
							<td>'.$r['mapel'].'</td>
							<td>'.$r['ruangan'].'</td>
							<td>'.$r['tentor_nama'].'</td>							
						</tr>
			
						';
			$i++;
		}
		$table='<table class="table table-striped">
							<tbody>
							<tr>
							  <th width="40" >#</th>
							  <th>Waktu</th>
							  <th>Program</th>
							  <th>Mapel</th>
							  <th>Ruangan</th>
							  <th>Nama Tentor</th>
							</tr>
							'.$tabelList.'
						</tbody>
					</table>';
		
		$html.='<div class="box box-info box-solid '.$v.'  ">
					<div class="box-header with-border">
					  <h3 class="box-title">'.$v.'</h3>

					  <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
						</button>
					  </div>
					  <!-- /.box-tools -->
					</div>
					<!-- /.box-header -->
					<div class="box-body" style="">
					 '.$table.'
					 
					 
					</div>
					<!-- /.box-body -->
				  </div>';
				  
				  
				  $no++;
			}

	 ?>
	  
	<table class="table table-striped">
		<thead>
			<tr>
				<td width="120">Nama Siswa </td><td>: <?= $data['nama_siswa'] ?></td>
			</tr>
			<tr>
				<td>Alamat </td><td>: <?= $data['alamat'] ?></td>
			</tr>
			<tr>
				<td>Jenjang </td><td>: <?= $detJadwal['jenjang'] ?></td>
			</tr>
			<tr>
				<td>Semester </td><td>: <?= $detJadwal['semester'] ?></td>
			</tr>
			<tr>
				<td>Tahunajaran </td><td>: <?= $detJadwal['tahunajaran'] ?></td>
			</tr>
		</thead>
	 </table> 
	
		<?= $html?>

</section>
</div>	
<?php include 'footer.php'; ?>