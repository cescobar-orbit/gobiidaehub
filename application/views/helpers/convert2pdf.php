<?php
    
	ob_start();
	echo $html;
	$content = ob_get_clean();
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	
	Bundle::start('laravel-html2pdf'); 
	$html2pdf = new HTML2PDF('P','LETTER','en');
	$html2pdf->writeHTML($content);
	
	return Response::make($html2pdf->Output(), 400, array('Content-type' => 'application/pdf',
	                                                      'Cache-Control' => 'no-cache', 
	                                                      'Accept-Ranges' => 'none',
	                                                      'Content-Disposition' => 'inline'));
?>