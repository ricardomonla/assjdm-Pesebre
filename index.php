<?php  

	include_once "./rmFxs.php";

	
	$tit = 'PesebreVivienteBY-22'; 
	
	$des = 'Pesebre Viviente del Barrio Yacampis - 2022';
	
	$ima = 'fondo.jpg';
	
	$tpo = 1;
	
	$dst = './Audios';


	rmRedir( $tit, $des, $dst, $ima, $tpo);

	die();
?>
