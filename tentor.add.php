<?php 
include'header.php'; 
$error='';
?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){	

 	$query="insert into tentor set tentor_nama='".$_POST['tentor_nama']."' , tentor_alamat='".$_POST['tentor_alamat']."',tentor_telepon='".$_POST['tentor_telepon']."' ,mapel_id='".$_POST['mapel_id']."',tentor_username='".$_POST['tentor_username']."',tentor_password='".md5($_POST['tentor_password'])."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil ditambah');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	} 
	
}



$optionMapel='';
$mapel=$system->db->getAll("select a.* , b.kelas,jenjang from mapel as a , kelas as b  where a.kelas_id=b.kelas_id order by a.mapel ASC");
/* adodb_pr($mapel);  */
foreach($mapel as $data){
	
	/* $selected=($data['kelas_id']==$r['kelas_id'])?'selected':''; */
	$optionMapel.='<option value="'.$data['mapel_id'].'"  >'.$data['mapel'].' ( '.$data['kelas'].' '.$data['jenjang'].'  )</option>';
}

?>


	  <section class="content-header">
		  <h1>
			Form Input Tentor
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
              <h3 class="box-title">Tambah Data Tentor</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="tentor_nama"  required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <textarea class="form-control" name="tentor_alamat" rows="3"  required=""></textarea>
					</div>
					<div class="form-group">
					  <label>Telepon</label>
					  <input type="text" class="form-control" name="tentor_telepon"  required>
					</div>
					<div class="form-group">
						<label>Matepelajaran</label>
						  <select name="mapel_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<?= $optionMapel ?>
						  </select>
					</div>
					<div class="form-group">
					  <label>Username</label>
					  <input type="text" class="form-control" name="tentor_username"  required>
					</div>
					<div class="form-group">
					  <label>Password</label>
					  <input type="text" class="form-control" name="tentor_password"  required>
					</div>

				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				  </div>
            </form>
          </div>

    </section>
</div>	
<?php include 'footer.php'; ?>