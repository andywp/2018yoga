<?php 
include'header.php'; 
$error='';
/*hapus data kelas */
if(isset($_POST['simpan'])){	
	$query="insert into absens_siswa set id_jadwal_siswa='".$_POST['id_jadwal_siswa']."',keterangan='".$_POST['keterangan']."',tanggal='".$_POST['tanggal']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil ditambah');
		$_POST=array();
		unset($_POST);
	}else{
		$error=alert('error','Gagal menyimpan');
	}
	
}




$jadwal=$system->db->getRow('select * from jadwal where jadwal_id='.$_GET['id']);


?>
<style>
	.box-header {
		color: #444;
		display: block;
		padding: 20px 10px;
		position: relative;
	}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Absensi Bibingan Belajar <?= $jadwal['jenjang']  ?>  <?= $jadwal['tahunajaran'] ?> Semester <?= $jadwal['semester'] ?> 
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll('select a.*, b.nama_siswa from absens_siswa as a , siswa as b ,jadwal_siswa as c where a.id_jadwal_siswa=c.id_jadwal_siswa and c.id_siswa=b.id_siswa and c.jadwal_id='.$jadwal['jadwal_id']);
		/* adodb_pr($data); */
		$no=1;
		$tabel='';
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['nama_siswa'].'</td>
						<td>'.date_indo($r['tanggal'],true,true).'</td>
						<td>'.$r['keterangan'].'</td>
					</tr>	';
			$no++;
		}

		
		
		
	
	$data=$system->db->getAll('select a.*, b.nama_siswa from jadwal_siswa as a , siswa as b where a.id_siswa=.b.id_siswa and a.jadwal_id='.$jadwal['jadwal_id']);
	
	$user='';
	foreach($data as $r){
		$user.='<option value="'.$r['id_jadwal_siswa'].'" >'.$r['nama_siswa'].'</option>';
	}
	
	
	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
	<a href="absensi.siswa.list.html" type="button" class="btn  btn-primary" >Kembali</a>
		<div class="box">
		
            <div class="box-header">
              <h3 class="box-title">Kelola Absensi </h3>
			  <div class="box-tools">
				<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal">Input Absensi</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Siswa</th>
                  <th>Tanggal</th>
                  <th class="text-center" >Keterangan</th>
                </tr>
                <?= $tabel ?>
				</tbody>
			  </table>
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



<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Input Absensi  <?= $jadwal['jenjang']  ?>  <?= $jadwal['tahunajaran'] ?> Semester <?= $jadwal['semester'] ?> </h4>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
				<label>Siswa</label>
				<select name="id_jadwal_siswa" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				<option value="" >Pilih</option>
				<?= $user ?>
				</select>
			</div>
			<div class="form-group">
				<label>Keterangan</label>
				<select name="keterangan" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
				<option value="" >Pilih Keterangan</option>
				<option value="Hadir" >Hadir</option>
				<option value="Alfa" >Izin</option>
				<option value="Sakit" >Sakit</option>
				<option value="Alfa" >Alva</option>
				
				</select>
			</div>
			<div class="form-group">
				<label>Tanggal:</label>
				<div class="input-group">
				  <div class="input-group-addon">
					<i class="fa fa-clock-o"></i>
				  </div>
				  <input type="text" name="tanggal" class="form-control pull-right date-timepicker" required>
				</div>
				<!-- /.input group -->
			</div>
		  </div>
		  <div class="modal-footer">
			
			<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>
		</div>
	</form>
  </div>
</div>



<?php include 'footer.php'; ?>