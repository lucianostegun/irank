	<div id="eventLiveResume">
		<div id="eventLiveList">
			<h1>Agenda em destaque</h1>
			<div id="eventLiveResumeList">
				<?php include_partial('home/resume/eventLive/eventList', array('limit'=>5, 'offset'=>0, 'eventDate'=>null)) ?>
				<div class="clear"></div>
			</div>
		</div>
		<div class="loadEvents">
			<?php echo link_to('carregar mais eventos', 'eventLive/index') ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php MyTools::addStylesheet('eventLiveResume') ?>