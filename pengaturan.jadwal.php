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

if(isset($_POST['addjadwal'])){
	
	adodb_pr($_POST);
	
	
}





?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Pengaturan Jadwal 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	 
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Pengaturan Jadwal</h3>
			  <div class="box-tools">
                <a href="jadwa.tambah.siswa.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah </i></a>
              </div>
            </div>
	
         </div>
         <div class="box-body no-padding">
		<?php
			$jadwal=$system->db->getAll("select * from jadwal_siswa as a , jadwal as b where a.jadwal_id=b.jadwal_id and a.id_siswa=".$_SESSION['id_admin']."  ");
			$no=1;
			$html='';
			foreach($jadwal as $r){
				$html.='<tr>
							<td>'.$no.'</td>
							<td>'.$r['jenjang'].'</td>
							<td>'.$r['semester'].'</td>
							<td>'.$r['tahunajaran'].'</td>
							<td width="100" ><a href="jadwal.lihat.siswa.html?id='.$r['jadwal_id'].'" title="lihat Jadwal" class="btn btn-info">Lihat Jadwal</a> </td>
							<td width="100"  ><a href="" title="lihat Jadwal" class="btn btn-success">Ubah</a> </td>
							
						
						</tr>
						';
				$no++;
			}
			
		
		?>
			<table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Jenjang</th>
                  <th>Semester</th>
                  <th>Tahuna Ajaran</th>
                  <th colspan="2" class="text-center" >Ation</th>
                </tr>
                <?= @$html ?>
				</tbody>
			  </table> 
		 
		 
		 
		 
		 </div>
		<div class="box-footer clearfix">
			
		</div>
     </div> 

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>