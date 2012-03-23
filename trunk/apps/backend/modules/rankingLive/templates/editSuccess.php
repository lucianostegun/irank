<?php
	echo form_remote_tag(array(
		'url'=>'rankingLive/save',
		'success'=>'handleSuccessRankingLive(request.responseText)',
		'failure'=>'handleFailureRankingLive(request.responseText)',
		'loading'=>'showIndicator("rankingLive")',
		'encoding'=>'UTF8',
	), array('id'=>'rankingLiveForm'));
	
	echo input_hidden_tag('rankingLiveId', $rankingLiveObj->getId());
?>
	<article class="module width_form">
	<header><h3 class="tabs_involved" id="mainRecordName"><?php echo $rankingLiveObj->getRankingName() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
	</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('rankingLive/tab/main', array('rankingLiveObj'=>$rankingLiveObj)) ?></div>
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'rankingLive')) ?>
</article><!-- end of content manager article -->
</form>