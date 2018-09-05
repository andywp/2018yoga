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
       Ansensi 
        
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
              <h3 class="box-title">Data Absensi Siswa</h3>
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
							<td width="100" ><a href="absensi.user.siswa.list.html?id='.$r['id_jadwal_siswa'].'" class="btn btn-info "  >Lihat</a></td>
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
                  <th class="text-center" >Ation</th>
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

<!-- Modal -->
<div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="title" class="modal-title"></h4>
      </div>
      <div class="modal-body load-detail">
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



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
				  <label>Pembayaran Bulan</label>
				  <select name="kelas_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
					<option value="" >Pilih</option>
					<option value="1" >Januari</option>
					<option value="2" >Febuari</option>
					<option value="3" >Maret</option>
					<option value="4" >April</option>
					<option value="5" >Mei</option>
					<option value="6" >Juni</option>
					<option value="7">Juli</option>
					<option value="8" >Agustus</option>
					<option value="9" >September</option>
					<option value="10">Oktober</option>
					<option value="11" >November</option>
					<option value="12" >Desember</option>
					
				  <section>
				</div>
			</form>
			
		  </div>
		  <div class="modal-footer">
			<input type="hidden" value="" id="jadwal_id" name="id_jadwal_siswa">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	</form>
  </div>
</div>








<?php include 'footer.php'; ?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.payment').click(function() { 
			 var jadwal_id 	= $(this).data('id');
			 var title 	= $(this).data('title');
			 var xajaxFile = "pembayaran.ajax.php";
			 $.ajax({
				type: "POST",
				url: xajaxFile,
				data: $.param({jadwal_id:jadwal_id}),
				/* dataType: 'json', */
				success: function(data){
					/* $('#detail').modal('show'); */
					if(data){
						/* $(".pesen").html();
						$('.alertID').hide(); */
						
						$("#title").html(title);
						$(".load-detail").html(data);
						$('#detail').modal('show');
					}				
				} 
			});
			 return false;
		});
		
		
		$(".konfrim").click(function(){ 
			var jadwal_id 	= $(this).data('id');
			var title 	= $(this).data('title');
			
			$("#jadwal_id").val(jadwal_id);
			$("#judul").html(title);
			$('#myModal').modal('show');
			 
			
			
		});

		
		
	});
</script>