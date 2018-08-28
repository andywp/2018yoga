<?php 
include'header.php'; 
$error='';
$jadwalSiswa=$system->db->getRow("select * from jadwal_siswa where id_jadwal_siswa=".$_GET['id']);
$jadwal_id=$jadwalSiswa['jadwal_id'];
$jadwal=$system->db->getRow("select * from jadwal where jadwal_id=".$jadwal_id);

if(isset($_POST['simpan'])){
	$src='';
	$tmp='';
	$tmp1='';
	$file_name = $_FILES['images_file']['name'];
	$file_size =$_FILES['images_file']['size'];
	$file_tmp =	$_FILES['images_file']['tmp_name'];
	$file_type=$_FILES['images_file']['type'];
	$file_ext=@strtolower(end(explode('.',$_FILES['images_file']['name'])));
	$expensions= array("jpg","jpeg","png");
	$filesave=date('Ymdhis').str_replace("image/",".",$_FILES['images_file']['type']);
	list($width,$height)=getimagesize($file_tmp);
	$newwidth=600;
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	imagecopyresampled($tmp,imagecreatefromjpeg($file_tmp),0,0,0,0,$newwidth,$newheight, $width,$height);
	$filename = 'images/'.$filesave;
	imagejpeg($tmp,$filename,100);
	
	$query="update pembayaran set bukti_upload='".$filesave."' where pembayaran_id='".$_POST['pembayaran_id']."' ";
	$simpan=$system->db->execute($query);
	if($simpan){
		$error=alert('success','Bukti pembayaran akan kami verifikasi ');
	}else{
		$error=alert('error','error kirim bukti pebayaran');
	}
	
	
	
}



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Bibingan Belajar <?= $jadwal['jenjang'] ?> <?=  $jadwal['tahunajaran']  ?> <?=  $jadwal['semester']  ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php


		$data=$system->db->getAll("select * from pembayaran where id_siswa='".$_SESSION['id_admin']."' and id_jadwal_siswa='".$_GET['id']."' order by pembayaran_id desc");	
		
		$tabel='';
		$no=1;
		foreach($data as $r){
			
			$detail=$system->db->getAll("select * from 	detail_pebayaran where pembayaran_id='".$r['pembayaran_id']."'");
			$det='';
			foreach($detail as $d){
				$det.='<tr>
							<td width="130" >'.$d['bulan'].'</td>
							<td> Rp. '.rupiah($d['biaya']).'</td>
					</tr>';
			}
			
			
			$konfirmasi=($r['approve']==1)?'<a class="btn btn-block btn-info" href="pembayaran.pdf.html?id='.$r['pembayaran_id'].'">Cetak PDF</a>':'<button type="button" data-id="'.$r['pembayaran_id'].'" class="btn btn-block btn-danger konfrim">Konfirmasi Bayar</a>';
			
			if($r['approve']==0){
				if(!empty($r['bukti_upload'])){
					$status='Sedang di verifikasi';
				}else{
					$status='Belum dikonfirmasi';
				}	
			}else{
				$status='Lunas';
			}
			
			
			$bukti=!empty($r['bukti_upload'])?'<button style="margin-top:10px; width:100%;" type="button" data-img="'.$r['bukti_upload'].'" class="btn btn-warning btn-info images">Lihat Bukti Pembayaran</button>':'';
			
			
			$tabel.='<tr>
						<td>'.$no.'</td>
						<td width="200">'.date('d F Y', strtotime($r['tanggal'])).'</td>
						<td  >
							<table>
								'.$det.'
							</table>
						</td>
						<td width="200" >Rp. '.rupiah($r['total_bayar']).'</td>
						<td>'.$status.'</td>
						<td>'.$konfirmasi.$bukti.'</td>
					</tr>';
					
			$no++;
		}
		
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Data Pembayaran</h3>
			  <div class="box-tools">
               <!--  <a href="mapel.add.html" class="btn btn-block btn-primary"><i class="fa fa-plus"> Tambah</i></a> -->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
				<br>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >#</th>
                  <th>Tanggal</th>
                  <th>Detail</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th colspan="2" class="text-center" >Ation</th>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
    <!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" id="judul">Konfirmasi Bayar</h4>
		  </div>
		  <div class="modal-body">
			<form  role="form" method="POST" enctype="multipart/form-data" action="">
				<div class="form-group">
				  <label>Upload bukti</label>
				  <input type="file" name="images_file" accept="image/gif,image/jpeg,image/jpg,image/png," required>
				</div>
			</form>
			
		  </div>
		  <div class="modal-footer">
			<input type="hidden" value="" id="pembayaran_id" name="pembayaran_id">
			<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>
		</div>
	</form>
  </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">
		$(".konfrim").click(function(){ 
			var pembayaran_id 	= $(this).data('id');
			
			
			$("#pembayaran_id").val(pembayaran_id);
			
			$('#myModal').modal('show');
			 
			
			
		});
</script>