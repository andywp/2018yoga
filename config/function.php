<?php

function alert($alert,$pesan){
	
	switch($alert){
		case 'error':
		$out='<div class="alert alert-danger alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
				  '.$pesan.'
				</div>';
		break;
		case 'info':
		$out='<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                '.$pesan.'
              </div>';
		break;
		case 'success':
		$out='<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                '.$pesan.'
              </div>';
		break;
	}
	
	return $out;
}
function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}


function date_indo($strDate,$setDay=true,$setTime=false){
	
	$arrDate = explode(' ',$strDate);
	$getDate = @$arrDate[0];
	$getTime = @$arrDate[1];
	$xDate	 = explode('-',$getDate);
	$xTime	 = explode(':',$getTime);
	
	$month = array(
		
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'00' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	
	$day  	= array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	$getDay = $setDay==true?$day[date('w', strtotime($getDate))].', ':'';
	$date 	= '<span class="date"> '.$getDay.@$xDate[2].' '.@$month[$xDate[1]].' '.@$xDate[0]. ' </span>';
	$time 	= $setTime==true?'<span class="time"> '.date("h:i a", strtotime($getTime)).'</span>':'';
	$time 	= $setTime==true?'<span class="time"> '.date("h:i a", strtotime($getTime)).'</span>':'';
	

	$date_indo = !empty($time)?$date.$time:$date;
	
	return $date_indo;
}

?>