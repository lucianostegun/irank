<?php
	$sf_content = utf8_decode($sf_data->getRaw('sf_content'));

	if ( get_magic_quotes_gpc() )
		$sf_content = stripslashes($sf_content);
	
	$paper         = 'A4';
//	$orientation   = 'landscape';
	$orientation   = 'portrait';
	$fileName      = isset($fileName)?$fileName:'irank.pdf';
	$forceDownload = isset($forceDownload)?$forceDownload:false;
	
	$sfWebDir = sfConfig::get('sf_web_dir');
	$sfLibDir = sfConfig::get('sf_lib_dir');
	
	$sf_content = str_replace('[webDir]', $sfWebDir, $sf_content);
	
	require_once("$sfLibDir/dompdf/dompdf_config.inc.php");
	try{
		
		$dompdf = new DOMPDF();
		$dompdf->load_html($sf_content);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->render();
		$dompdf->stream($fileName, array('Attachment'=>true));
	}catch(Exception $e){
		
		echo 'error';
	}
	
	exit;
?>