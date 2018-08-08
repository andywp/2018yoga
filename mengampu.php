<?php 
include'header.php'; 
$error='';
/*hapus data kelas */

$tentor=$system->db->getRow("select * from tentor where tentor_id='".$_GET['id']."'");

if(isset($_POST['simpan'])){
	
	
	
	
	if(empty($_POST['mapel_id'])){
		$error=alert('error','Pilih mata pelajaran');
	}else{
		$cek=$system->db->getOne("select id_mengampu from mengampu where tentor_id='".$_GET['id']."' and mapel_id='".$_POST['mapel_id']."'");
		if($cek){
			$error=alert('error','Data sudah ada');
		}else{
			
			$query="insert into mengampu set tentor_id='".$_GET['id']."' , mapel_id='".$_POST['mapel_id']."' ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil ditambahkan');
			}else{
				$error=alert('error','Gagal disimpan');
			}
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
      <h1>Data Mengampu</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php

		$optionMapel='';
		$kelas=$system->db->getAll("select a.mapel_id,mapel, b.kelas,jenjang from mapel as a ,kelas as b where b.kelas_id=a.kelas_id   ");
		
		foreach($kelas as $r){
			$optionMapel.='<option value="'.$r['mapel_id'].'">'.$r['mapel'].' ( '.$r['kelas'].' - '.$r['jenjang'].' )</option>';
		}

		$dataKelas=$system->db->getAll("select a.id_mengampu, b.mapel, c.kelas,jenjang from  mengampu as a, mapel as b, kelas as c where a.mapel_id=b.mapel_id and b.kelas_id=c.kelas_id and a.tentor_id='".$_GET['id']."'");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['mapel'].'</td>
						<td>'.$r['kelas'].'</td>
						<td>'.$r['jenjang'].'</td>
						<td width="50" ><a href="mengampu.html?id='.$_GET['id'].'&act=hapus&id_hapus='.$r['id_mengampu'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
					</tr>	';
			$no++;
		}

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Mengampu</h3>
			 <table class="table table-striped">
			  <div class="box-tools">
				<ul class="list-inline list-unstyled">
                <li><a href="jadwal.html" class="btn btn-block btn-danger" ><i class="fa fa-arrow-left"> Kembali</i></a></li>
               <li> <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Tambah</i></button></li>
				</ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<table class="table table-striped">
					<thead>
						<tr>
							<td width="80">Nama </td><td>: <?= $tentor['tentor_nama'] ?></td>
						</tr>
						<tr>
							<td>Alamat </td><td>: <?= $tentor['tentor_alamat'] ?></td>
						</tr>
						<tr>
							<td>Telepon </td><td>: <?= $tentor['tentor_telepon'] ?></td>
						</tr>
					</thead>
					
				</table>
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Mapel</th>
                  <th>Kelas</th>
                  <th>Jenjang</th>
                  <th>Ation</th>
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
			<label>Mapel</label>
				  <select name="mapel_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
					<option value="" >Pilih</option>
					<?= $optionMapel ?>
				  </select>
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