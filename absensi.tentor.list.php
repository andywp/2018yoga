<?php 
include'header.php'; 
$error='';



if(@$_GET['act']=='hapus' && @$_GET['id'] !='' ){
	
	$query="delete from mapel where mapel_id='".$_GET['id']."'";
	$hapus=$system->db->execute($query);
	if($hapus){
		$error=alert('success','Data berhasil dihapus');
	}else{
		$error=alert('error','Gagal menghapus data');
	}	
	
	
	
}

/*update status*/
if(isset($_POST['status'])){
	$query="UPDATE jadwal set status='".$_POST['status']."' where jadwal_id='".$_POST['jadwal_id']."' ";
	$hapus=$system->db->execute($query);
	
	if($hapus){
		$error=alert('success','Data berhasil perbaruhui');
	}else{
		$error=alert('error','Gagal diperbaruhi');
	}
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Absensi Tentor
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll("select * from  jadwal  order by jadwal_id DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			
			$aktif=($r['status']==1)?'selected':'';
			$NOaktif=($r['status']==0)?'selected':'';
			
			
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['tahunajaran'].'</td>
						<td>'.$r['semester'].'</td>
	
						<td width="50" ><a href="absensi.tentor.input.html?id='.$r['jadwal_id'].'" class="btn btn-block btn-success">Absensi</a></td>
					</tr>	';
			$no++;
		}

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Pilih Jadwal</h3>
			  <div class="box-tools">
               <!-- <a href="jadwal.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Tahunajaran</th>
                  <th>Semester</th>
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