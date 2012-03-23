<?php
	echo form_remote_tag(array(
		'url'=>'club/save',
		'success'=>'handleSuccessClub(request.responseText)',
		'failure'=>'handleFailureClub(request.responseText)',
		'loading'=>'showIndicator("club")',
		'encoding'=>'UTF8',
	), array('id'=>'clubForm'));
	
	echo input_hidden_tag('clubId', $clubObj->getId());
?>
	<article class="module width_full">
	<header><h3 class="tabs_involved" id="mainRecordName"><?php echo $clubObj->getClubName() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab3">Eventos</a></li>
		<li><a href="#tab2">Rankings</a></li>
	</ul>
	</header>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('club/tab/main', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('club/tab/event', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab3" class="tab_content"><?php include_partial('club/tab/ranking', array('clubObj'=>$clubObj)) ?></div>
		
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'club')) ?>
</article><!-- end of content manager article -->
</form>