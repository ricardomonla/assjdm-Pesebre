<?php  

	include_once "./rmFxs.php";

	
	$tit = 'PesebreVivienteBY-25'; 
	
	$des = 'Pesebre Viviente del Barrio Yacampis - 2025';
	
	$ima = 'fondo.jpg';
	
	$tpo = 1;
	
	$dst = './Audios';


	rmRedir( $tit, $des, $dst, $ima, $tpo);

	die();
?>
