<?php 
include'header.php'; 
$error='';
$jadwalSiswa=$system->db->getRow("select * from jadwal_siswa where id_jadwal_siswa=".$_GET['id']);
$jadwal_id=$jadwalSiswa['jadwal_id'];
$jadwal=$system->db->getRow("select * from jadwal where jadwal_id=".$jadwal_id);
$biaya=$jadwal['biaya'];
if($jadwal['semester']=='Ganjil'){
	$bulan=array('Juli','Agustus','September','Oktober','November','Desember');
}else{
	$bulan=array('Januari','Februari','Maret','April','Mei','Juni');
}










?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pembayaran Bibingan Belajar <?= $jadwal['jenjang'] ?> <?=  $jadwal['tahunajaran']  ?> <?=  $jadwal['semester']  ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		if(isset($_POST['simpan'])){
			/* adodb_pr($_POST); */
			if(empty($_POST['bulan'])){
				$error=alert('error','Silahkan pilih bulan');
			}else{
			$query="insert into pembayaran set id_jadwal_siswa='".$_POST['id_jadawal_siswa']."', id_siswa='".$_SESSION['id_admin']."', tanggal='".date('Y-m-d')."' ";
				$simpan=$system->db->execute($query);
				if($simpan){
				$id_bayar=$system->db->insert_id();
					$total=0;
					foreach($_POST['bulan'] as $k=>$v){
						$save="insert into detail_pebayaran set pembayaran_id='".$id_bayar."', bulan='".$v."', biaya='".$_POST['biaya']."' ";
						$insert=$system->db->execute($save);						
						$total +=$_POST['biaya'];
					}
					$update="update pembayaran set total_bayar='".$total."' where pembayaran_id='".$id_bayar."' ";
					$tot=$system->db->execute($update);
					if($tot){
						$error=alert('success','Pembayaran berhasil dibuat silahkan malukan  Transver ke BNI 021356353 sejumlah '.$total);
						
						echo '<script>window.location="pembayaran.input.html?id='.$_GET['id'].'&sukses=true&total='.$total.'";</script>';
					}else{
						$error=alert('error','Gagal menyimpan');
					}
					
				}

			}
		}

		
		
		/* $cek_pebayaran_id=$system->db->getOne("select pembayaran_id from pembayaran where id_jadwal_siswa='".$_GET['id']."' and id_siswa='".$_SESSION['id_admin']."' order by pembayaran_id desc"); */
		$tabel=''; 
		foreach($bulan as $k=>$v){
		$cek=$system->db->getOne("select a.detail_pebayaran_id from detail_pebayaran as a, pembayaran as b where a.pembayaran_id=b.pembayaran_id and a.bulan='".$v."' and b.id_jadwal_siswa='".$_GET['id']."' and id_siswa='".$_SESSION['id_admin']."'   "); 
		if($cek){
			$disabled='disabled';
		}else{
			$disabled='';
		}	
			
		$tabel.='<tr>
					<td>
						<div class="form-group">
							<div class="checkbox">
								<label>
								  <input type="checkbox" name="bulan[]" value="'.$v.'" '.$disabled.'>
								</label>
							</div>
						</div>
					 </td>
					 <td>'.$v.'</td>
					 <td>Rp.  '.rupiah($biaya).'</td>
				</tr>
				';
		}
	
	?>
	
	<style>
		.checkbox, .radio {
			position: relative;
			display: block;
			margin-top: 0;
			margin-bottom: 0;
		}
	</style>
	
    <!-- Main content -->
    <section class="content">
	
		<?php if(@$_GET['sukses']=='true' && $_GET['total'] !='' ){
			echo	alert('success','Pembayaran berhasil dibuat silahkan malukan  Transver ke BNI 021356353 sejumlah '.rupiah(urldecode($_GET['total'])).'<br><a href="pembayaran.html" class="btn btn-danger">Kembali</a>' );
			
		}else{
		?>
	
	
		<form  role="form" method="POST" enctype="multipart/form-data" action="">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Buat Pembayaran</h3>
			  <div class="box-tools">
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
				<?= $error ?>
              <table class="table table-striped">
                <tbody>
				<tr>
                  <th width="40" >Pilih</th>
                  <th>Bulan</th>
                  <th>Biaya</th>
                </tr>
                <?= $tabel ?>
				</tbody>
			  </table>
			</form>
            </div>
            <!-- /.box-body -->
			<div class="box-footer clearfix">
				<input type="hidden" value="<?= $biaya ?>" name="biaya">
				<input type="hidden" value="<?= $_GET['id'] ?>" name="id_jadawal_siswa">
				<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
				<a href="pembayaran.html" class="btn btn-success">Kembali</a>
			</div>
          </div>
		</form>
		
		<?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'footer.php'; ?>