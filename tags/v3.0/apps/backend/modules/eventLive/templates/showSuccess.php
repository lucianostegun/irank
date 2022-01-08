<div class="wrapper">
	<?php if( $eventLiveObj->isPastDate() && !$eventLiveObj->isEditable() ): ?>
	<div class="nNote nWarning hideit">
	    <p><strong>ATENÇÃO: </strong>Este evento não pode mais ser editado pois seu resultado já foi salvo e já existem outros eventos posteriores a ele.</p>
	</div>
	<?php endif; ?>
	
	<!-- Fullscreen tabs -->
    <div class="widget form">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Resultado</a></li>
			<li><a href="#tab3">Fotos</a></li>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('eventLive/show/main', array('eventLiveObj'=>$eventLiveObj, 'clubId'=>$clubId, 'iRankAdmin'=>$iRankAdmin)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('eventLive/show/result', array('eventLiveObj'=>$eventLiveObj)) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('eventLive/tab/photos', array('eventLiveId'=>$eventLiveObj->getId())) ?></div>
		</div>
	</div>
</div>