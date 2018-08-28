<?php 
include'header.php'; 
$error='';
$jadwal=$system->db->getRow("select * from jadwal where jadwal_id=".$_GET['id']);
$biaya=$jadwal['biaya'];
if($jadwal['semester']=='Ganjil'){
	$bulan=array('Juli','Agustus','September','Oktober','November','Desember');
}else{
	$bulan=array('Januari','Februari','Maret','April','Mei','Juni');
}

if(@$_GET['id_pem'] !='' && @$_GET['konfirmasi'] =='ok' ){
echo	$approve="update pembayaran set approve=1 where pembayaran_id=".$_GET['id_pem'];
	$simpan=$system->db->execute($approve);
	if($simpan){
		$error=alert('success','Data berhasil dikonfirmasi');
		$_POST=array();
	}else{
		$error=alert('error','Gagal menyimpan');
	}
}





?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembayaran Bibingan Belajar <?= $jadwal['jenjang'] ?> <?= $jadwal['tahunajaran'] ?> <?= $jadwal['semester'] ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
	 
    </section>
	<?php
		
		$db=$system->db->getAll("select a.* ,b.id_siswa, c.nama_siswa  from pembayaran as a, jadwal_siswa as b ,siswa as c where a.id_jadwal_siswa=b.id_jadwal_siswa and b.id_siswa=c.id_siswa and b.jadwal_id=".$_GET['id']);
		/* adodb_pr($db); */
		$tabel='';
		$no=1;
		foreach($db as $r){
			$detail=$system->db->getAll("select * from 	detail_pebayaran where pembayaran_id='".$r['pembayaran_id']."'");
			$det='';
			foreach($detail as $d){
				$det.='<tr>
							<td width="130" >'.$d['bulan'].'</td>
							<td> Rp. '.rupiah($d['biaya']).'</td>
					</tr>';
			}
			
			$status=($r['approve']==1)?'Pembayaran diterima':'pending';
			
			
			$konfirmasi=!empty($r['bukti_upload'])?'<button type="button" data-img=\'<img src="images/'.$r['bukti_upload'].'" class="img-responsive" >\' class="btn btn-block btn-info konfrim"> Lihat Bukti Bayar</button>':'<button type="button" data-id="'.$r['pembayaran_id'].'" class="btn btn-block btn-info "> Bukti Belum Tersedia</button>';
			
			$tabel.='
					<tr>
						<td>'.$no.'</td>
						<td>'.date('d F Y', strtotime($r['tanggal'])).'</td>
						<td>'.$r['nama_siswa'].'</td>
						<td>
							<table>
								'.$det.'
							</table>
						</td>
						<td>'.$status.'</td>
						<td>
							'.$konfirmasi.'
							<a href="pembayaran.listing.html?id=2&id_pem='.$r['pembayaran_id'].'&konfirmasi=ok" data-id="'.$r['pembayaran_id'].'" class="btn btn-block btn-success"> Terima</a>
						</td>
					</tr>
			
					';
					
			$no++;
		}
		
		
	?>
	
	
	
    <!-- Main content -->
    <section class="content">
		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Data Pembayaran</h3>
			  <div class="box-tools">
               <form  role="form" method="POST" enctype="multipart/form-data" action="">
					<div class="form-group">
						<select name="tahunajaran" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
						<option value="" >Pilih Tahunajaran</option>
						<?php 
							$now=date('Y');
							for ($a=2017;$a<=$now;$a++){
								 $value=$a.'/'.($a+1);
								echo '<option value="'.$value.'" >'.$value.'</option>';
							}
						
						?>
						
						</select>
					</div>
			   </form>
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
                  <th>Nama</th>
                  <th>Rincian</th>
				  <th>Status</th>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form  role="form" method="POST" enctype="multipart/form-data" action="">
    <!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" id="judul">Bukti bayar</h4>
		  </div>
		  <div class="modal-body"  >
				<div id="loadimg"></div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		  </div>
		</div>
	</form>
  </div>
</div>

<?php include 'footer.php'; ?>
<script type="text/javascript">
	 $(document).ready(function() {
		$(".konfrim").click(function(){ 
			var gambar 	= $(this).data('img');
			

			
			$("#loadimg").html(gambar);
			
			$('#myModal').modal('show');
			
		});
	});
</script>