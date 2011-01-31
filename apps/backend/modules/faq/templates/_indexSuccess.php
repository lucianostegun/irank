<?php
	echo form_remote_tag(array(	'url'=>'faq/getXml',
								'success'=>'handleSuccessSearch( request.responseText, "faq" )',
								'failure'=>'handleFailureSearch( request.responseText, "faq" )',
								'loading'=>'resetPages("faq"); updatePaginator("faq")',
								'encoding'=>'utf8',
								), array( 'id'=>'faqForm' ));

	echo input_hidden_tag( 'instanceName', 'faq' );
	echo input_hidden_tag( 'limit', 50, array('id'=>'faqLimit') );
	echo input_hidden_tag( 'offset', 0, array('id'=>'faqOffset') );
	echo input_hidden_tag( 'databaseSortField', null, array('id'=>'faqDatabaseSortField') );
	echo input_hidden_tag( 'databaseSortDesc', null, array('id'=>'faqDatabaseSortDesc') );
	
	echo submit_image_tag( 'blank.gif' );


	$dhtmlxGridObj = new DhtmlxGrid();

	$questionField = input_tag('question', null, array('size'=>25, 'onfocus'=>'disableSorting()', 'onblur'=>'enableSorting()' ));

	$dhtmlxGridObj->setHeader( array(
								array('ID',					0,		'left',		'ro',	'int' ),
								array('Dúvida',				450,	'left',		'ro',	'str', FaqPeer::QUESTION ),
								array('Criado em',   		120,	'center',	'ro',	'str', FaqPeer::CREATED_AT )
								));
								
	$dhtmlxGridObj->setExtraHeader( array('#rspan', $questionField, '#rspan') );

	$dhtmlxGridObj->addHandler('onRowSelect', 'enableToolbarOnIndex');
	$dhtmlxGridObj->setXmlUrl( '/faq/getXml?grid=list' );
	$dhtmlxGridObj->setHeight(350);
	$dhtmlxGridObj->setFullHeight();
	$dhtmlxGridObj->setDoubleClickAction( 'doView("faq")', true );
	$dhtmlxGridObj->build();
?>
</form>
<div style="display: none" id="faqPaginatorDiv"><script>updatePaginator('faq')</script></div>