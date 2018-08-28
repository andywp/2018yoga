<?php
$URL=$_SERVER['SERVER_NAME'];
$baseURL=$_SERVER['PHP_SELF'];
$baseURL=$URL.str_replace('pembayaran.pdf.php','',$baseURL);
include 'session.php';
include 'config/db.php';
include 'config/function.php';
require_once("config/dompdf/dompdf_config.inc.php");

$db=$system->db->getROw('select * from pembayaran where pembayaran_id='.$_GET['id']);
$siswa=$system->db->getRow('select * from siswa where id_siswa="'.$db['id_siswa'].'" ');
$jadwal=$system->db->getRow('select * from jadwal_siswa as a , jadwal as b where a.jadwal_id=b.jadwal_id and a.id_jadwal_siswa='.$db['id_jadwal_siswa']);
/* adodb_pr($db); */
$html='<style>';
include 'css.php';
$html.='</style>';
$html.='<link rel="stylesheet" href="'.$baseURL.'asset/bootstrap/dist/css/bootstrap.min.css">';
$html.='<div class="container">
	<h1 class="text-center" >Bukti Pebayaran </h1>
	<table class="table table-striped" >
		<tr>
			<td>Pebayaran</td><td> Bibingan belajar '.$jadwal['jenjang'].'  '.$jadwal['tahunajaran'].'  '.$jadwal['semester'].'  </td>
		</tr>
		<tr>
			<td>Nama :</td><td> '.$siswa['nama_siswa'].' </td>
		</tr>
		<tr>
			<td>Alamat :</td><td> '.$siswa['alamat'].' </td>
		</tr>
		<tr>
			<td>Tanggal Bayar :</td><td> '.date('d F Y', strtotime($db['tanggal'])).' </td>
		</tr>
		
	</table>
</div>';

$html.='<h2>Rincian Pebayaran</h2>';


$detail=$system->db->getAll("select * from 	detail_pebayaran where pembayaran_id='".$db['pembayaran_id']."'");
$det='';
$no=1;
foreach($detail as $d){
	$det.='<tr>
				<td>'.$no.'</td>
				<td width="130" >'.$d['bulan'].'</td>
				<td> Rp. '.rupiah($d['biaya']).'</td>
		</tr>';
	$no++;
}
$html.='<table class="table table-striped">';
$html.='<thead>
			<tr>
				<td width="30" >#</td>
				<td>Bulan</td>
				<td text-align="right" >Biaya</td>
			</tr>
		</thead>
		<tbody>
			'.$det.'
			<tr>
				<td colspan="2">Total</td>
				<td>Rp. '.rupiah($db['total_bayar']).'</td>
			</tr>
		</tbody>
		
		';

$html.='</table>';








$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4','portrait');
$dompdf->set_base_path($baseURL.'asset/bootstrap/dist/css/bootstrap.min.css');
$dompdf->render();
$dompdf->stream("invoice_".$siswa['nama_siswa'].".pdf", array("Attachment" => true));   
 
?>
