	<div class="eventLiveResume">
		<div class="eventLiveList">
			<?php if( $includeTitle ): ?><h1>Agenda em destaque</h1><?php endif; ?>
			<div class="eventLiveResumeList">
				<?php include_partial('home/resume/eventLive/eventList', array('limit'=>$limit, 'offset'=>$offset, 'eventDate'=>null)) ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php if( $includeTitle ): ?>
		<div class="loadEvents">
			<?php echo link_to('carregar mais eventos', 'eventLive/index') ?>
		</div>
		<?php endif; ?>
		<div class="clear"></div>
	</div>