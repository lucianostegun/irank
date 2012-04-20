<!-- Fullscreen tabs -->
<div class="widget">       
    <ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
		<li><a href="#tab2">Eventos</a></li>
		<li><a href="#tab3">Rankings</a></li>
		<li><a href="#tab4">Fotos</a></li>
		<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#clubForm").submit()')); ?>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('club/tab/main', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab2" class="tab_content"><?php include_partial('club/tab/event', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab3" class="tab_content"><?php include_partial('club/tab/ranking', array('clubObj'=>$clubObj)) ?></div>
		<div id="tab4" class="tab_content"><?php include_partial('club/tab/photos', array('clubId'=>$clubId)) ?></div>
	</div>
</div>