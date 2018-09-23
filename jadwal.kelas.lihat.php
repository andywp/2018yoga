<?php 
include'header.php'; 
$error='';
$namekelas=$system->db->getOne("select kelas from kelas where kelas_id=".$_GET['id']);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>Data Jadwal <?= $namekelas ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php

/* 		$optionMapel='';
		$kelas=$system->db->getAll("select a.id_mengampu, b.kode,mapel, c.kelas,jenjang ,d.tentor_nama from  mengampu as a, mapel as b, kelas as c , tentor as d where a.mapel_id=b.mapel_id and b.kelas_id=c.kelas_id and a.tentor_id=d.tentor_id and b.kelas_id='".$jadwal['jenjang']."'");
		
		foreach($kelas as $r){
			$optionMapel.='<option value="'.$r['id_mengampu'].'">'.$r['mapel'].' ( '.$r['kelas'].' - '.$r['jenjang'].' / '.$r['tentor_nama'].' )</option>';
		}
 */
		
		
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
			
			$jadwalMengapu=$system->db->getAll('select a.*, b.tentor_nama, c.kode,mapel from detail_jadwal as a, tentor as b , mapel as c, mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and d.mapel_id=c.mapel_id and c.kelas_id="'.$_GET['id'].'" and a.hari="'.$v.'" ');
			/* adodb_pr($jadwalMengapu); */
			$tabelList='';
			$i=1;
			foreach($jadwalMengapu as $r){
				$tabelList.='
							<tr>
								<td>'.$i.'</td>
								<td>'.$r['jam'].'</td>
								<td>'.$r['program'].'</td>
								<td>'.$r['kode'].'</td>
								<td>'.$r['mapel'].'</td>
								<td>'.$r['ruangan'].'</td>
								<td>'.$r['tentor_nama'].'</td>
								<td width="50" ><a href="jadwal.tentor.html?id='.$_GET['id'].'&act=hapus&id_hapus='.$r['id_mengampu'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
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
								  <th>Kode Mapel</th>
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
              <h3 class="box-title">Jadawal Kelas <?= $namekelas ?></h3>
			  <br>
			  <br>
			
			  <div class="box-tools">
				<!--<ul class="list-inline list-unstyled">
                <li><a href="jadwal.html" class="btn btn-block btn-danger" ><i class="fa fa-arrow-left"> Kembali</i></a></li>
               <li> <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Tambah</i></button></li>
				</ul> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				
				
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
			<div class="form-group">
				<label>Program</label>
				  <select name="program" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				  <option value="" >Pilih</option>
				  <option value="Kelas" >Kelas</option>
				  <option value="Privat" >Privat</option>
					
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