<?php
	$dhtmlxGridObj = new DhtmlxGrid('i18n');

	$dhtmlxGridObj->setHeader( array(
								array('Idioma',		80,		'left',		'ro',	'str' ),
								array('Dúvida',		250,	'left',		'ed',	'str' ),
								array('Resposta',	'*',	'left',		'txt',	'str' )
								));
	
	$dhtmlxGridObj->addHandler( 'onEditCell', 'handleFaqAnswer' );
	$dhtmlxGridObj->setXmlUrl( '/faq/getXml?grid=i18n&faqId='.$faqId );
	$dhtmlxGridObj->setHeight(350);
	$dhtmlxGridObj->build();
?>