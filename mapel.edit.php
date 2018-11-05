<?php 
include'header.php'; 
$error='';

?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){
	$addQuery='';
	$kode=$system->db->getOne('select kode from mapel where mapel_id="'.$_POST['mapel_id'].'" ');
	if(empty($kode)){
		$jenjang=$system->db->getOne("select jenjang from kelas where kelas_id='".$_POST['kelas_id']."'");
		if($jenjang=='SMP'){
			$karakter=5;
		}
		if($jenjang=='SMA'){
			$karakter=5;
		}
		if($jenjang=='SD'){
			$karakter=4;
			/* $jenjang=$Jenjang.'0'; */
		}
		
		$cek=$system->db->getOne("SELECT max(kode)  FROM mapel WHERE kode LIKE '".substr(date('Y'),$karakter,4)."%'");
		$NoUrut = (int) substr($cek, $karakter, 4);
		$NoUrut++;
		$NewID = 'MP'.$jenjang.sprintf('%04s', $NoUrut);
		$_POST['kode']=$NewID;
		$addQuery.=' kode="'.$_POST['kode'].'" , ';
		
	}




	
	$query="update  mapel set ".$addQuery."  mapel='".$_POST['mapel']."' , kelas_id='".$_POST['kelas_id']."' where mapel_id='".$_POST['mapel_id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil diupdate');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	}
	
	
	
	
	
	
	
}



$r=$system->db->getRow("select * from mapel where mapel_id='".$_GET['id']."' ");
/* adodb_pr($r); */


$optionKelas='';
$kelas=$system->db->getAll("select * from kelas order by kelas ASC");
/* adodb_pr($kelas); */
foreach($kelas as $data){
	
	$selected=($data['kelas_id']==$r['kelas_id'])?'selected':'';
	$optionKelas.='<option value="'.$data['kelas_id'].'" '.$selected.' >'.$data['kelas'].' ( '.$data['jenjang'].' )</option>';
}




?>


<section class="content-header">
  <h1>
	Form Input Matapelajaran
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
              <h3 class="box-title">Edit Data Matapelajaran</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Matapelajaran</label>
					  <input type="text" class="form-control" name="mapel" value="<?= $r['mapel'] ?>"  required>
					</div>
					<div class="form-group">
						<label>Jenjang Kelas</label>
						  <select name="kelas_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<?= $optionKelas ?>
						  </select>
					</div>

				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="mapel_id" value="<?= $r['mapel_id'] ?>">
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				  </div>
            </form>
          </div>

    </section>
</div>	
<?php include 'footer.php'; ?>