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


?>