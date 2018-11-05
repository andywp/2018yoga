<?php 
include'header.php'; 
$error='';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembayaran Bibingan Belajar 
        
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
						<td>'.$r['paket'].'</td>
						<td width="50" ><a href="pembayaran.listing.html?id='.$r['jadwal_id'].'" class="btn btn-block btn-success">Data Pembayaran</a></td>
					</tr>	';
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
                  <th>Tahunajaran</th>
                  <th>Semester</th>
                  <th>Paket</th>
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