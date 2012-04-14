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
	</ul>
	<div class="tab_container">
		<?php
			echo form_tag('eventLive/save', array('class'=>'form', 'id'=>'eventLiveForm'));
			echo input_hidden_tag('eventLiveId', $eventLiveObj->getId());
			
			if( !$iRankAdmin )
				echo input_hidden_tag('clubId', $clubId);
		?>
		<div id="tab1" class="tab_content"><?php include_partial('eventLive/tab/main', array('eventLiveObj'=>$eventLiveObj, 'clubId'=>$clubId, 'iRankAdmin'=>$iRankAdmin)) ?></div>
		</form>
		<div id="tab2" class="tab_content"><?php include_partial('eventLive/tab/players', array('eventLiveObj'=>$eventLiveObj)) ?></div>
		<div id="tab3" class="tab_content"><?php include_partial('eventLive/tab/result', array('eventLiveObj'=>$eventLiveObj)) ?></div>
		<div id="tab4" class="tab_content"><?php include_partial('eventLive/tab/photos', array('eventLiveObj'=>$eventLiveObj)) ?></div>
	</div>
</div>