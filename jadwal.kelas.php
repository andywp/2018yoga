<?php  
include'header.php'; 
$error='';
/*hapus data kelas */

if(@$_GET['act']=='hapus' && @$_GET['id'] !='' ){
	
	$query="delete from kelas where kelas_id='".$_GET['id']."'";
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
        Data Kelas 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll("select * from kelas order by kelas_id DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['kelas'].'</td>
						<td>'.$r['jenjang'].'</td>
						<td width="50" ><a href="jadwal.kelas.lihat.html?id='.$r['kelas_id'].'" class="btn btn-block btn-success">LIhat Jadwal</a></td>
					</tr>	';
			$no++;
		}

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Jadwal Perkelas</h3>
			 <!-- <div class="box-tools">
                <a href="kelas.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Kelas</th>
                  <th>Jenjang</th>
                  <th class="text-center" >Ation</th>
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