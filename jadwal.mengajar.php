<?php 
include'header.php'; 
$error='';
/*hapus data kelas */


if(isset($_POST['simpan'])){
	
	
	$cek=$system->db->getOne("select detail_id from mengampu where id_mengampu='".$_POST['id_mengampu']."' and hari='".$_POST['hari']."' and jam='".$_POST['jam']."'");
	if($cek){
		$error=alert('error','Pengajar sudah ada dengan hari dan jam ');
	}else{
		
		$query="insert into detail_jadwal set id_mengampu='".$_POST['id_mengampu']."' , hari='".$_POST['hari']."', jam='".$_POST['jam']."', ruangan='".$_POST['ruangan']."',jadwal_id='".$_POST['jadwal_id']."' ";
		$simpan=$system->db->execute($query);
		if($simpan){
			$error=alert('success','Data berhasil ditambahkan');
		}else{
			$error=alert('error','Gagal disimpan');
		}
	}
		
	
	
	
}


if(@$_GET['act']=='hapus' && @$_GET['id_hapus'] !='' ){
	
	$query="delete from mengampu where id_mengampu='".$_GET['id_hapus']."'";
	$hapus=$system->db->execute($query);
	if($hapus){
		$error=alert('success','Data berhasil dihapus');
	}else{
		$error=alert('error','Gagal menghapus data');
	}	
	
	
	
}




?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Jadwal Mengampu</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		
		$dataUSER=$system->db->getRow("select * from tentor where tentor_id='".$_SESSION['id_admin']."'");
		/* adodb_pr($dataUSER); */
		
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
			
			$jadwalMengapu=$system->db->getAll('select a.*, b.tentor_nama, c.mapel from detail_jadwal as a, tentor as b , mapel as c, mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and d.mapel_id=c.mapel_id  and a.hari="'.$v.'" and b.tentor_id="'.$dataUSER['tentor_id'].'" ');
			/* adodb_pr($jadwalMengapu); */
			$tabelList='';
			$i=1;
			foreach($jadwalMengapu as $r){
				$tabelList.='
							<tr>
								<td>'.$i.'</td>
								<td>'.$r['jam'].'</td>
								<td>'.$r['mapel'].'</td>
								<td>'.$r['ruangan'].'</td>
								<td>'.$r['tentor_nama'].'</td>
								<td width="50" ><a href="jadwal.tentor.html?id='.$r['detail_id'].'&act=hapus&id_hapus='.$r['id_mengampu'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
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
		

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Jadwal Mengampu</h3>
			 <table class="table table-striped">
			  <div class="box-tools">
			<!--	<ul class="list-inline list-unstyled">
                <li><a href="tentor.html" class="btn btn-block btn-danger" ><i class="fa fa-arrow-left"> Kembali</i></a></li>
               <li> <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Tambah</i></button></li>
				</ul> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				
				<table class="table table-striped">
					<thead>
						<tr>
							<td width="80">Nama </td><td>: <?= $dataUSER['tentor_nama'] ?></td>
						</tr>
						<tr>
							<td>Tahunajaran </td><td>: </td>
						</tr>
						<tr>
							<td>Semester </td><td>:</td>
						</tr>
					</thead>
					
				</table>
				<?= $error ?>
				<?= $html ?>
             
            </div>
            <!-- /.box-body -->
			<div class="box-footer clearfix">
				<?#= $peging ?>
			</div>
          </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form  role="form" method="POST" enctype="multipart/form-data" action="">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Data Mengampu</h4>
        </div>
        <div class="modal-body">
         
			<div class="form-group">
				<label>Tentor</label>
				  <select name="id_mengampu" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
					<option value="" >Pilih</option>
					<?= $optionMapel ?>
				  </select>
			</div>
			<div class="form-group">
				<label>Hari</label>
				  <select name="hari" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				  <option value="" >Pilih</option>
					<option value="Senin" >Senin</option>
					<option value="Selasa" >Selasa</option>
					<option value="Rabu" >Rabu</option>
					<option value="Kamis" >Kamis</option>
					<option value="Jumat" >Jumat</option>
					<option value="Sabtu" >Sabtu</option>
				  </select>
			</div>
			<div class="form-group">
				<label>Jam</label>
				  <select name="jam" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				  <option value="" >Pilih</option>
					<option value="13:00-14:45" >13:00-14:00</option>
					<option value="15:00-16:45" >15:00-16:45</option>
				  </select>
			</div>
			<div class="form-group">
				<label>Ruang</label>
				  <select name="ruangan" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				  <option value="" >Pilih</option>
					<option value="A" >A</option>
					<option value="B" >B</option>
					<option value="C" >C</option>
					<option value="D" >D</option>
					<option value="E" >E</option>
				  </select>
			</div>
		
        </div>
        <div class="modal-footer">
			<input type="hidden" name="jadwal_id" value="<?= $jadwal['jadwal_id'] ?>">
			<button type="submit" name="simpan" value="simpan" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
 </div>
<?php include 'footer.php'; ?>