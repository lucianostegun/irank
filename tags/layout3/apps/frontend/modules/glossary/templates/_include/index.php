<div class="glossaryIndex">
<?php
	if( $letter )
		$letterList = array($letter);
	else
		$letterList = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','#');
	
	foreach($letterList as $letter):
?>
<h1 class="glossaryLetter"><?php echo $letter ?></h1>
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