<div class="tabbarIntro"><?php echo __('event.playersTab.intro') ?></div>
<div id="eventPlayerDiv">
			<?php
				if( !$eventObj->isNew() )
					include_partial('event/include/player', array('eventObj'=>$eventObj)) ?>
</div>