<?php
	$pathList = array('Glossário de termos'=>'glossary/index', 
					  $letter=>null);
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
	
	$criteria = new Criteria();
	$criteria->add( GlossaryPeer::VISIBLE, true );
	$criteria->add( GlossaryPeer::ENABLED, true );
	$criteria->add( GlossaryPeer::DELETED, false );
	$criteria->add( GlossaryPeer::TERM, $letter.'%', Criteria::ILIKE );
	$criteria->addAscendingOrderByColumn( 'RANDOM()' );
	$glossaryObj = GlossaryPeer::doSelectOne($criteria);
	
	if( !is_object($glossaryObj) ){
		
		$glossaryObj = new Glossary();
		$glossaryObj->setTerm('I');
		$glossaryObj->setDescription('Nenhum termo encontrado com a letra '.$letter);
	}
?>
<div class="moduleIntro termDetails pb20">
	<h1><?php echo $glossaryObj->getTerm() ?></h1>
	<div class="clear pt10"></div>
	<?php echo $glossaryObj->getDescription() ?>
	<div class="clear"></div>
</div>
<hr class="separator"/>
<?php include_partial('glossary/include/index', array('letter'=>$letter)) ?>