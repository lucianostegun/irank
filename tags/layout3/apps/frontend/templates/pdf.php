<?php
	$sf_content = utf8_decode($sf_data->getRaw('sf_content'));

	if ( get_magic_quotes_gpc() )
		$sf_content = stripslashes($sf_content);
	
	$paper       = 'A4';
//	$orientation = 'landscape';
	$orientation = 'portrait';
	
	$sfWebDir = sfConfig::get('sf_web_dir');
	$sfLibDir = sfConfig::get('sf_lib_dir');
	
	$sf_content = str_replace('[webDir]', $sfWebDir, $sf_content);
	
	require_once("$sfLibDir/dompdf/dompdf_config.inc.php");
	
	$dompdf = new DOMPDF();
	$dompdf->load_html($sf_content);
	$dompdf->set_paper($paper, $orientation);
	$dompdf->set_paper($paper, $orientation);
	$dompdf->render();
	$dompdf->stream("irank.pdf", array("Attachment" => !Util::isDebug()));
	exit;
?>