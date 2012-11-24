<div class="tabbarIntro">Lista de jogadores já inscritos no ranking</div>

<div id="rankingPlayerDiv">
	<?php
		include_partial('ranking/include/player', array('rankingObj'=>$rankingObj, 'readOnly'=>true));
	?>
</div>
