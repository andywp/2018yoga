<?php 
include'header.php'; 
$error='';
?>
<div class="content-wrapper">

<?php
/* /* echo "SELECT max(kode)  FROM tentor  "; */ 
if(isset($_POST['simpan'])){	
	$addQuery='';
	$kode=$system->db->getOne('select kode from tentor where mapel_id="'.$_POST['tentor_id'].'" ');
	if(empty($kode)){
		
		$cek=$system->db->getOne("SELECT max(kode)  FROM tentor ");
		$NoUrut = (int) substr($cek, 2, 4);
		$NoUrut++;
		$NewID = 'T'.sprintf('%04s', $NoUrut);
		$_POST['kode']=$NewID;
		$addQuery.=' kode="'.$_POST['kode'].'" , ';
	}
	
	
	
	
 	$query="update tentor set ".$addQuery." tentor_nama='".$_POST['tentor_nama']."' , tentor_alamat='".$_POST['tentor_alamat']."',tentor_telepon='".$_POST['tentor_telepon']."' ,tentor_username='".$_POST['tentor_username']."' where tentor_id='".$_POST['tentor_id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil ditambah');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	} 
	
}

$r=$system->db->getRow("select * from tentor where tentor_id='".$_GET['id']."'");
/* adodb_pr($r); */

$optionMapel='';
$mapel=$system->db->getAll("select a.* , b.kelas,jenjang from mapel as a , kelas as b  where a.kelas_id=b.kelas_id order by a.mapel ASC");
/* adodb_pr($mapel);  */
foreach($mapel as $data){
	
	$selected=($data['mapel_id']==$r['mapel_id'])?'selected':''; 
	$optionMapel.='<option value="'.$data['mapel_id'].'" '.$selected.'  >'.$data['mapel'].' ( '.$data['kelas'].' '.$data['jenjang'].'  )</option>';
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
              <h3 class="box-title">Edit Data Tentor</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="tentor_nama" value="<?= $r['tentor_nama'] ?>"  required>
					</div>
					<div class="form-group">
					  <label>Alamat</label>
					  <textarea class="form-control" name="tentor_alamat" rows="3"  required=""><?= $r['tentor_alamat'] ?></textarea>
					</div>
					<div class="form-group">
					  <label>Telepon</label>
					  <input type="text" class="form-control" name="tentor_telepon" value="<?= $r['tentor_telepon'] ?>"  required>
					</div>
				<!--	<div class="form-group">
						<label>Matepelajaran</label>
						  <select name="mapel_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<?= $optionMapel ?>
						  </select>
					</div> -->
					<div class="form-group">
					  <label>Username</label>
					  <input type="text" class="form-control" name="tentor_username"  value="<?= $r['tentor_username'] ?>"  required>
					</div>
				<!--	<div class="form-group">
					  <label>Password</label>
					  <input type="text" class="form-control" name="tentor_password"  required>
					</div> -->

				</div>
				<!-- /.box-body -->

				  <div class="box-footer">
					<input type="hidden" value="<?= $r['tentor_id'] ?>" name="tentor_id">
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				  </div>
            </form>
          </div>

    </section>
</div>	
<?php include 'footer.php'; ?>