<?php 
include'header.php'; 
$error='';
$pesan='';
?>
<div class="content-wrapper">

<?php
if(isset($_POST['simpan'])){	
		if(empty($_POST['kelas'])){
			$pesan.='<li>Nama Kelas tidak boleh kosong</li>';
		}
		if(empty($_POST['jenjang'])){
			$pesan.='<li>Pilih jenjang</li>';
		}
		$cek=$system->db->getOne("select kelas_id from kelas where kelas='".$_POST['kelas']."' and jenjang='".$_POST['jenjang']."'  ");
		if($cek){
			$pesan.='<li>Nama Kelas tidak Boleh sama</li>';
		}

		
		if(!empty($pesan)){
			$error=alert('error','<ul>'.$pesan.'</ul>');	
		}else{
			$query="insert into kelas set kelas='".$_POST['kelas']."' , jenjang='".$_POST['jenjang']."' ";
			$simpan=$system->db->execute($query);
			if($simpan){
				$error=alert('success','Data berhasil ditambah');
				$_POST=array();
			}else{
				$error=alert('error','Gagal menyimpan');
			}
		}
	
}

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
              <h3 class="box-title">Tambah Data Kelas</h3>
            </div>
            <!-- /.box-header -->
				<!-- form start -->
				<?=  @$error ?>
				<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="box-body">
					<div class="form-group">
					  <label>Nama</label>
					  <input type="text" class="form-control" name="kelas"  required>
					</div>
					<div class="form-group">
						<label>Jenjang Kelas</label>
						  <select name="jenjang" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
							<option>Pilih</option>
							<option value="SD">SEKOLAH DASAR (SD)</option>
							<option value="SMP">SEKOLAH MENENGAH PERTAMA (SMP)</option>
							<option value="SMA">SEKOLAH MENENGAH ATAS (SMA)</option>
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