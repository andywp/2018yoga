<?php 
include'header.php'; 
$error='';
$data=$system->db->getRow("select * from jadwal where jadwal_id='".$_GET['id']."'");

/*hapus data kelas */
?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){	
	$query="update  jadwal set kelas_id='".$_POST['kelas_id']."' ,tahunajaran='".$_POST['tahunajaran']."' ,semester='".$_POST['semester']."', paket='".$_POST['paket']."',type='".$_POST['type']."', biaya='".$_POST['biaya']."' where jadwal_id='".$_GET['id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil DIUBAH');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	}
	
}

$kelas=$system->db->getAll('select * from kelas GROUP by jenjang');
/* adodb_pr($kelas); */
$opttKelas='';
foreach($kelas as $r){
	
	$selected=($data['kelas_id']==$r['kelas_id'])?'selected':'';
	$opttKelas.='<option value="'.$r['kelas_id'].'" '.$selected.' >'.$r['kelas'].' ( '.$r['jenjang'].' )</option>';
}



?>


<section class="content-header">
  <h1>
	Form Edit Jadwal
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
              <h3 class="box-title">Edit Data Jadwal</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
						<label>Nama Jadwal</label>
						<input type="text" class="form-control" name="paket" value="<?= $data['paket'] ?>" required>
					</div>
					<div class="form-group">
						<label>Kelas</label>
						  <select name="kelas_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option value="" >Pilih</option>
							<?= $opttKelas ?>
						  </select>
					</div>
					
					<div class="form-group">
						<label>Tahunajaran</label>
						<select name="tahunajaran" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
						<option value="" >Pilih</option>
						<?php 
							$now=date('Y');
							for ($a=2017;$a<=$now;$a++){
								 $value=$a.'/'.($a+1);
								 $selected=($data['tahunajaran']== $value)?'selected':'';
								 
								echo '<option value="'.$value.'" '.$selected.' >'.$value.'</option>';
							}
						
						?>
						
						</select>
					</div>
					<div class="form-group">
						<label>Semester</label>
						<select name="semester" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
						<option value="" >Pilih</option>
						<option value="Ganjil" <?= ($data['semester']=='Ganjil')?'selected':''; ?> >Ganjil</option>
						<option value="Genap" <?= ($data['semester']=='Genap')?'selected':''; ?> >Genap</option>
						</select>
					</div>
					 
					<div class="form-group">
						<label>Jenis Kelas</label>
						<select name="type" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
						<option value="" >Pilih</option>
						<option value="private" <?= ($data['type']=='private')?'selected':''; ?> >Private</option>
						<option value="kelas" <?= ($data['type']=='kelas')?'selected':''; ?> >Kelas</option>
						</select>
					</div>
					<div class="form-group">
					  <label>Biaya Per Bulan</label>
					  <input type="text" class="form-control" name="biaya" value="<?= $data['biaya'] ?>"  required>
					</div>
						  <div class="box-footer">
							<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
						  </div>
					</form>
				  </div>

    </section>
</div>	
<?php include 'footer.php'; ?>