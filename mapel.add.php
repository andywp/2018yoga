<?php 
include'header.php'; 
$error='';

?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){	
	$query="insert into mapel set kode='".$_POST['kode']."', mapel='".$_POST['mapel']."' , kelas_id='".$_POST['kelas_id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Data berhasil ditambah');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	}
	
}


$optionKelas='';
$kelas=$system->db->getAll("select * from kelas order by kelas ASC");
/* adodb_pr($kelas); */
foreach($kelas as $r){
	$optionKelas.='<option value="'.$r['kelas_id'].'">'.$r['kelas'].' ( '.$r['jenjang'].' )</option>';
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
              <h3 class="box-title">Tambah Data Matapelajaran</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Kode</label>
					  <input type="text" max="8" min="8" class="form-control" name="kode"  required>
					</div>
					<div class="form-group">
					  <label>Matapelajaran</label>
					  <input type="text" class="form-control" name="mapel"  required>
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
					<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				  </div>
            </form>
          </div>

    </section>
</div>	
<?php include 'footer.php'; ?>