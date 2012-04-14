<?php
	$iRankAdmin = $sf_user->hasCredential('iRankAdmin');
	$clubId     = $sf_user->getAttribute('clubId');
?><!-- Fullscreen tabs -->
<div class="widget form">    
    <ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Jogadores</a></li>
		<li><a href="#tab3">Resultado</a></li>
		<li><a href="#tab4">Fotos</a></li>
		<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#eventLiveForm").submit()')); ?>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('eventLive/tab/main', array('eventLiveObj'=>$eventLiveObj, 'clubId'=>$clubId, 'iRankAdmin'=>$iRankAdmin)) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('eventLive/tab/players', array('eventLiveObj'=>$eventLiveObj)) ?></div>
		<div id="tab3" class="tab_content"><?php include_partial('eventLive/tab/result', array('eventLiveObj'=>$eventLiveObj)) ?></div>
		<div id="tab4" class="tab_content"><?php include_partial('eventLive/tab/photos', array('eventLiveObj'=>$eventLiveObj)) ?></div>
	</div>
</div>