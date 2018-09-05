<?php 
include'header.php'; 
$error='';
/*hapus data kelas */
if(isset($_POST['simpan'])){	
	$query="insert into absensi_tentor set detail_id='".$_POST['detail_id']."',keterangan='".$_POST['keterangan']."',tanggal='".$_POST['tanggal']."' ";
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
		$dataKelas=$system->db->getAll("select a.detail_id, b.tentor_nama ,c.* from detail_jadwal as a, tentor as b , absensi_tentor as c , mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and c.detail_id=a.detail_id and a.jadwal_id=".$jadwal['jadwal_id']);
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['tentor_nama'].'</td>
						<td>'.date_indo($r['tanggal'],true,true).'</td>
						<td>'.$r['keterangan'].'</td>
					</tr>	';
			$no++;
		}

	
	$jadwalMengapu=$system->db->getAll('select a.detail_id, b.tentor_nama ,c.mapel from detail_jadwal as a, tentor as b , mapel as c, mengampu as d where a.id_mengampu=d.id_mengampu and d.tentor_id=b.tentor_id and d.mapel_id=c.mapel_id and a.jadwal_id="'.$jadwal['jadwal_id'].'"  group by b.tentor_nama ');
	
	/* adodb_pr($jadwalMengapu); */
	$user='';
	foreach($jadwalMengapu as $r){
		$user.='<option value="'.$r['detail_id'].'" >'.$r['tentor_nama'].' ( '.$r['mapel'].')</option>';
	}
	
	
	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
	<a href="absensi.tentor.list.html" type="button" class="btn  btn-primary" >Kembali</a>
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
                  <th>Tentor</th>
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
				<label>Tentor</label>
				<select name="detail_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
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