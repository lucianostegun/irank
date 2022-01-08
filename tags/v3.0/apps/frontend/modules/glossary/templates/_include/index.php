<div class="glossaryTermFilter">
<?php
	if( $letter )
		$letterList = array($letter);
	else
		$letterList = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','#');
	
	foreach($letterList as $letter)
		echo link_to($letter, '##'.($letter=='#'?'number':$letter));
?>
</div>
<div class="glossaryIndex">
<?php
	foreach($letterList as $letter):
?>
<h1 class="glossaryLetter" id="<?php echo ($letter=='#'?'number':$letter) ?>"><?php echo $letter ?></h1>
<hr/>
<?php
	$criteria = new Criteria();
	$criteria->add( GlossaryPeer::VISIBLE, true );
	$criteria->add( GlossaryPeer::ENABLED, true );
	$criteria->add( GlossaryPeer::DELETED, false );
	if( $letter=='#' )
		$criteria->add( GlossaryPeer::TERM, '^[0-9]', '~*' );
	else
		$criteria->add( GlossaryPeer::TERM, $letter.'%', Criteria::ILIKE );
	$glossaryObjList = GlossaryPeer::doSelect($criteria);
	
	foreach($glossaryObjList as $glossaryObj):
	
		$term = $glossaryObj->getTerm();
		
		$resume = $glossaryObj->getDescription();
		$resume = truncate_text($resume, 110);
		$resume = strip_tags($resume);
?>
	<div class="term" onclick="goToPage('glossary', 'term/<?php echo $term ?>')">
		<label><?php echo $term ?></label>
		<span class="resume"><?php echo $resume ?></span>
	</div>
	<div class="clear"></div>
	<?php endforeach; ?>
<?php endforeach; ?>
</div>