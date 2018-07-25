<?php 
include'header.php'; 
$error='';






?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){	
	$query="update  kelas set kelas='".$_POST['kelas']."' , jenjang='".$_POST['jenjang']."' where kelas_id='".$_POST['kelas_id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil diupdate');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	}
	
}
$kelas_id=$_GET['id'];
$data=$system->db->getRow("select * from kelas where kelas_id='".$kelas_id."'");
/* adodb_pr($data); */
?>


	  <section class="content-header">
		  <h1>
			Form Input Kelas
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
              <h3 class="box-title">Edit Data Kelas</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="kelas" value="<?= $data['kelas'] ?>"  required>
					</div>
					<div class="form-group">
						<label>Jenjang Kelas</label>
						  <select name="jenjang" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<option value="SD" <?= ($data['jenjang']=='SD')?'selected':'';  ?> >SEKOLAH DASAR (SD)</option>
							<option value="SMP" <?= ($data['jenjang']=='SMP')?'selected':'';  ?> >SEKOLAH MENENGAH PERTAMA (SMP)</option>
							<option value="SMA" <?= ($data['jenjang']=='SMA')?'selected':'';  ?> >SEKOLAH MENENGAH ATAS (SMA)</option>
						  </select>
					</div>

				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" name="kelas_id" value="<?= $data['kelas_id'] ?>">
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				  </div>
            </form>
          </div>

    </section>
</div>	
<?php include 'footer.php'; ?>