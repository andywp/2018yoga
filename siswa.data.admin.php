<?php 
include'header.php'; 
$error='';
/*hapus data kelas */

if(@$_GET['act']=='hapus' && @$_GET['id'] !='' ){
	
	$query="delete from mapel where mapel_id='".$_GET['id']."'";
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
      <h1>
        Data Siswa 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll("SELECT * FROM  siswa order by id_siswa DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['kode'].'</td>
						<td>'.$r['nama_siswa'].'</td>
						<td>'.$r['email'].'</td>
						<td>
							<table>
								<tr>
									<td>Alamat</td><td>'.$r['alamat'].'</td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td><td>'.$r['gender'].'</td>
								</tr>
								<tr>
									<td>Nama Orangtua</td><td>'.$r['nama_ortu'].'</td>
								</tr>
								<tr>
									<td>No Telepon</td><td>'.$r['no_hp'].'</td>
								</tr>
								<tr>
									<td>Email</td><td>'.$r['email'].'</td>
								</tr>
							</table>
						</td>
						
					</tr>	';
			$no++;
		}

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Laporan Data siswa</h3>
			  <div class="box-tools">
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
				  <th>Kode</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Detail</th>
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

<?php include 'footer.php'; ?>