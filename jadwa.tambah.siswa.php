<?php 
include'header.php'; 
$error='';
?>
<div class="content-wrapper">

<?php
if(@$_GET['act']=='save'){	

 	$query="insert into jadwal_siswa set id_siswa='".$_SESSION['id_admin']."' , id_detail_jadwal='".$_GET['id_detail']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','jadwa berhasil ditambah');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	} 
	
}



$optionMapel='';
$mapel=$system->db->getAll("select * from jadwal order by jadwal_id DESC");
/* adodb_pr($mapel);  */
foreach($mapel as $data){
	
	 $selected=($data['jadwal_id']==$_GET['id_jadwal'])?'selected':''; 
	$optionMapel.='<option value="'.$data['jadwal_id'].'" '. $selected.'  >'.$data['jenjang'].' ( '.$data['tahunajaran'].' - '.$data['semester'].'  )</option>';
}

?>


	  <section class="content-header">
		  <h1>
			Form Input Jadwal
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		  </ol>
	 
    </section>


    <section class="content">
		 <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Jadwal</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="get" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
						<label>Pilih Kelas</label>
						  <select name="id_jadwal" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<?= $optionMapel ?>
						  </select>
					</div>
				</div>
				<!-- /.box-body -->
				  <div class="box-footer">
					<button type="submit" name="Buka" class="btn btn-primary">Buka</button>
				  </div>
            </form>
          </div>
		 <?php
		 $html='';
			$data=$system->db->getRow("select * from siswa where id_siswa='".$_SESSION['id_admin']."'");
			/* adodb_pr($data); */
			
			if(isset($_GET['id_jadwal'])){
				$hari=array(
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu'
		);
		/* adodb_pr($hari); */
		$html='';
		foreach($hari as $k=>$v){
			
			$jadwalMengapu=$system->db->getAll('select a.*, b.tentor_nama, c.mapel from detail_jadwal as a, tentor as b , mapel as c, mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and d.mapel_id=c.mapel_id and a.jadwal_id="'.$_GET['id_jadwal'].'" and a.hari="'.$v.'" ');
			/* adodb_pr($jadwalMengapu); */
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
								<td><a href="jadwa.tambah.siswa.html?id_jadwal='.$_GET['id_jadwal'].'&act=save&id_detail='.$r['detail_id'].'" class="btn btn-info">Tambah Ke jadwal</a></td>
								
							</tr>
				
							';
				$i++;
			}
			
			//$tabelList=!empty($tabelList)?$tabelList:alert('error','Jadwal belum tersedia');
			
			
			
			$table='<table class="table table-striped">
								<tbody>
								<tr>
								  <th width="40" >#</th>
								  <th>Waktu</th>
								  <th>Program</th>
								  <th>Mapel</th>
								  <th>Ruangan</th>
								  <th>Nama Tentor</th>
								  <th>Ation</th>
								</tr>
								'.$tabelList.'
							</tbody>
						</table>';
			
			
			
			$html.='<div class="box box-info box-solid '.$v.'">
						<div class="box-header with-border">
						  <h3 class="box-title">'.$v.'</h3>

						  <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
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
				}
				
				
				
				
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
			</thead>
		 </table> 
		  <?= $html ?>

    </section>
</div>	
<?php include 'footer.php'; ?>