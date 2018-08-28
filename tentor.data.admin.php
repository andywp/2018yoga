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
        Data Tentor 
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		$dataKelas=$system->db->getAll("SELECT * FROM  tentor order by tentor_id DESC");
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			
			$mengampu=$system->db->getAll("select * from mengampu as a , mapel as b, kelas as c where a.mapel_id=b.mapel_id and b.kelas_id=c.kelas_id and a.tentor_id='".$r['tentor_id']."'");
		
			$det='';
			foreach($mengampu as $d){
				$det.='
						<tr>
							<td>'.$d['mapel'].'  '.$d['kelas'].'   '.$d['jenjang'].'</td>
						</tr>
				
						';
			}
			
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['tentor_nama'].'</td>
						<td>
							<table>
								<tr>
									<td>Alamat</td><td>'.$r['tentor_alamat'].'</td>
								</tr>
								<tr>
									<td>No Telepon</td><td>'.$r['tentor_telepon'].'</td>
								</tr>
								
							</table>
						</td>
						<td>
							<table>
								'.$det.'
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
              <h3 class="box-title">Laporan Data Tentor</h3>
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
                  <th>Nama</th>
                  <th>Detail</th>
                  <th>Mengampu</th>
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