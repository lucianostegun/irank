<?php
	echo form_remote_tag(array(
		'url'=>'eventLive/save',
		'success'=>'handleSuccessEventLive(request.responseText)',
		'failure'=>'handleFailureEventLive(request.responseText)',
		'loading'=>'showIndicator("eventLive")',
		'encoding'=>'UTF8',
	), array('id'=>'eventLiveForm'));
	
	$iRankAdmin = $sf_user->hasCredential('iRankAdmin');

	echo input_hidden_tag('eventLiveId', $eventLiveObj->getId());
	
	if( !$iRankAdmin ){

		$clubId = $sf_user->getAttribute('clubId');
		echo input_hidden_tag('clubId', $clubId);
	}
?>
	<article class="module width_form">
	<header>
		<h3 class="tabs_involved" id="mainRecordName"><?php echo $eventLiveObj->toString() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Jogadores</a></li>
		<li><a href="#tab3">Resultado</a></li>
	</ul>
	</header>
	<?php include_partial('home/include/formHeader', array('prefix'=>'eventLive')) ?>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('eventLive/tab/main', array('eventLiveObj'=>$eventLiveObj, 'clubId'=>$clubId, 'iRankAdmin'=>$iRankAdmin)) ?></div>
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'eventLive')) ?>
</article><!-- end of content manager article -->
</form>