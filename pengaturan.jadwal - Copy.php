  <?php 
include'header.php'; 
$error='';
/*hapus data kelas */
if(@$_GET['act']=='hapus' && @$_GET['id'] !='' ){
	
	$query="delete from mapel where mapel_id='".$_GET['id']."'";
	$hapus=$system->db->execute($query);
	if($hapus){
		$error=alert('success','Data berhasil dihapus');
	}else{
		$error=alert('error','Gagal menghapus data');
	}	
	
}

if(isset($_POST['addjadwal'])){
	
	adodb_pr($_POST);
	
	
}





?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Pengaturan Jadwal 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll("select a.* , b.kelas,jenjang from mapel as a , kelas as b  where a.kelas_id=b.kelas_id order by a.mapel_id DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['mapel'].'</td>
						<td>'.$r['kelas'].'</td>
						<td>'.$r['jenjang'].'</td>
						<td width="50" ><a href="mapel.edit.html?id='.$r['mapel_id'].'" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a></td>
						<td width="50" ><a href="mapel.html?act=hapus&id='.$r['mapel_id'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
					</tr>	';
			$no++;
		}
	
	

		
	
	
	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Jadwal</h3>
			  <div class="box-tools">
                <a href="jadwa.tambah.siswa.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah </i></a>
              </div>
            </div>
			<form  role="form" method="POST" class="" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								  <select name="jenjang"   class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
									<option value="" >Pilih Kelas</option>
									<option value="SD" >SD</option>
									<option value="SMP" >SMP</option>
									<option value="SMA" >SMA</option>
									<?#= $optionMapel ?>
								  </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								  <select name="id_jadwal"  class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
									<option value="" >Pilih Semester</option>
									<option value="Ganjil" >Ganjil</option>
									<option value="Genap" >Genap</option>
									
									<?#= $optionMapel ?>
								  </select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<button type="submit" name="addjadwal" class="btn btn-primary">Lihat Jadwal</button>
							</div>
						</div>
					</div>
				</div>
			<!-- /.box-body -->
			  
			</form>
            <div class="box-body no-padding">
				<?= $error ?>
           <!--   <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Mapel</th>
                  <th>Kelas</th>
                  <th>Jenjang</th>
                  <th colspan="2" class="text-center" >Ation</th>
                </tr>
                <?= $tabel ?>
				</tbody>
			  </table> -->
            </div>
          
			<div class="box-footer clearfix">
				<?#= $peging ?>
			</div>
          </div> 

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>