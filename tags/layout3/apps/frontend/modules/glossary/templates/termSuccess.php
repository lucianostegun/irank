<?php
	$pathList = array('Glossário de termos'=>'glossary/index', 
					  $letter=>"glossary/letter?$letter=",
					  $term=>null);
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<div class="moduleIntro termDetails pb20">
	<h1><?php echo $glossaryObj->getTerm() ?></h1>
	<div class="clear pt10"></div>
	<?php echo $glossaryObj->getDescription() ?>
	<div class="clear"></div>
</div>
<div class="separator"></div>
<?php include_partial('glossary/include/index', array('letter'=>$letter)) ?>