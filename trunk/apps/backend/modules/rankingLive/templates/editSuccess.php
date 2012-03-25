<?php
	echo form_remote_tag(array(
		'url'=>'rankingLive/save',
		'success'=>'handleSuccessRankingLive(request.responseText)',
		'failure'=>'handleFailureRankingLive(request.responseText)',
		'loading'=>'showIndicator("rankingLive")',
		'encoding'=>'UTF8',
	), array('id'=>'rankingLiveForm'));
	
	$iRankAdmin  = $sf_user->hasCredential('iRankAdmin');
	$userAdminId = $sf_user->getAttribute('userAdminId');
	$clubId      = $sf_user->getAttribute('clubId');
	
	echo input_hidden_tag('rankingLiveId', $rankingLiveObj->getId());
	
	if( !$iRankAdmin && $clubId )
		echo input_hidden_tag('clubId', $clubId);
?>
	<article class="module width_full">
	<header><h3 class="tabs_involved" id="mainRecordName"><?php echo $rankingLiveObj->getRankingName() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Etapas</a></li>
		<li><a href="#tab3">Classificação</a></li>
	</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('rankingLive/tab/main', array('rankingLiveObj'=>$rankingLiveObj, 'iRankAdmin'=>$iRankAdmin, 'userAdminId'=>$userAdminId)) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('rankingLive/tab/event', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'rankingLive')) ?>
</article><!-- end of content manager article -->
</form>