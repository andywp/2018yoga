<?php 
include'header.php'; 
$error='';
/*hapus data kelas */

if(@$_GET['act']=='hapus' && @$_GET['id'] !='' ){
	
	$query="delete from tentor where tentor_id='".$_GET['id']."'";
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
		$dataKelas=$system->db->getAll("select * from tentor order by tentor_id DESC");
		
		$tabel='';
		$no=1;
		foreach($dataKelas as $r){
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td>'.$r['kode'].'</td>
						<td>'.$r['tentor_nama'].'</td>
						<td>'.$r['tentor_alamat'].'</td>
						<td>'.$r['tentor_telepon'].'</td>
						
						<td><a href="mengampu.html?id='.$r['tentor_id'].'" class="btn btn-info btn-sm" >Mengampu</a></td>
						<td width="50" >
						<a href="tentor.edit.html?id='.$r['tentor_id'].'" class="btn btn-block btn-success"><i class="fa fa-edit"></i></a></td>
						<td width="50" ><a href="tentor.html?act=hapus&id='.$r['tentor_id'].'" onclick="return confirm (\'hapus data....?\')  " class="btn btn-block btn-danger"><i class="fa fa-trash-o"></i></a></td>
					</tr>	';
			$no++;
		}

	
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Tentor</h3>
			  <div class="box-tools">
                <a href="tentor.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a>
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
                  <th>Tentor</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                 
				
                  <th colspan="3" class="text-center" >Ation</th>
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