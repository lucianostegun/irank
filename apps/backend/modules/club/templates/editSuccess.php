<?php
	echo form_remote_tag(array(
		'url'=>'club/save',
		'success'=>'handleSuccessClub(request.responseText)',
		'failure'=>'handleFailureClub(request.responseText)',
		'loading'=>'showIndicator("club")',
		'encoding'=>'UTF8',
	), array('id'=>'clubForm'));
	
	$clubId = $clubObj->getId();
	
	echo input_hidden_tag('clubId', $clubId);
?>
	<article class="module width_full">
	<header><h3 class="tabs_involved" id="mainRecordName"><?php echo $clubObj->getClubName() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Eventos</a></li>
		<li><a href="#tab3">Rankings</a></li>
		<li><a href="#tab4">Fotos</a></li>
	</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('club/tab/main', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('club/tab/event', array('clubId'=>$clubId)) ?></div>
		<div id="tab3" class="tab_content"><?php include_partial('club/tab/ranking', array('clubId'=>$clubId)) ?></div>
		<div id="tab4" class="tab_content"><?php include_partial('club/tab/photos', array('clubId'=>$clubId)) ?></div>
		
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'club')) ?>
</article><!-- end of content manager article -->
</form>