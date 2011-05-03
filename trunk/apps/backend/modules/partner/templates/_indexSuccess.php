<?php
	echo form_remote_tag(array(	'url'=>'partner/getXml',
								'success'=>'handleSuccessSearch( request.responseText, "partner" )',
								'failure'=>'handleFailureSearch( request.responseText, "partner" )',
								'loading'=>'resetPages("partner"); updatePaginator("partner")',
								'encoding'=>'utf8',
								), array( 'id'=>'partnerForm' ));

	echo input_hidden_tag('instanceName', 'partner');
	echo input_hidden_tag('limit', 50, array('id'=>'partnerLimit'));
	echo input_hidden_tag('offset', 0, array('id'=>'partnerOffset'));
	echo input_hidden_tag('databaseSortField', null, array('id'=>'partnerDatabaseSortField'));
	echo input_hidden_tag('databaseSortDesc', null, array('id'=>'partnerDatabaseSortDesc'));
	
	echo submit_image_tag('blank.gif');


	$dhtmlxGridObj = new DhtmlxGrid();

	$partnerNameField     = input_tag('partnerName', null, array('size'=>25, 'onfocus'=>'disableSorting()', 'onblur'=>'enableSorting()' ));
	$externalUrlNameField = input_tag('externalUrl', null, array('size'=>25, 'onfocus'=>'disableSorting()', 'onblur'=>'enableSorting()' ));
	$fileNameField        = input_tag('fileName', null, array('size'=>25, 'onfocus'=>'disableSorting()', 'onblur'=>'enableSorting()' ));

	$dhtmlxGridObj->setHeader( array(
								array('ID',					0,		'left',		'ro',	'int' ),
								array('Parceiro',			150,	'left',		'ro',	'str', PartnerPeer::PARTNER_NAME ),
								array('Link externo',		250,	'left',		'ro',	'str', PartnerPeer::EXTERNAL_URL ),
								array('Imagem',				150,	'left',		'ro',	'str', FilePeer::FILE_NAME ),
								array('Criado em',   		120,	'center',	'ro',	'str', PartnerPeer::CREATED_AT )
								));
								
	$dhtmlxGridObj->setExtraHeader( array('#rspan', $partnerNameField, $externalUrlNameField, $fileNameField, '#rspan') );

	$dhtmlxGridObj->addHandler('onRowSelect', 'enableToolbarOnIndex');
	$dhtmlxGridObj->setXmlUrl( '/partner/getXml?grid=list' );
	$dhtmlxGridObj->setHeight(350);
	$dhtmlxGridObj->setFullHeight();
	$dhtmlxGridObj->setDoubleClickAction( 'doView("partner")', true );
	$dhtmlxGridObj->build();
?>
</form>
<div style="display: none" id="partnerPaginatorDiv"><script>updatePaginator('partner')</script></div>