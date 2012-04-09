	<div id="eventLiveResume">
		<div id="eventLiveList">
			<h1>Agenda em destaque</h1>
			<div id="eventLiveResumeList">
				<div id="eventLiveResumeLoader">
					<div id="eventLiveResumeLoaderArea"></div>
					<div id="eventLiveResumeLoaderContent">
						<?php echo image_tag('home/eventResumeLoader.gif') ?><br/>
						<span>carregando lista de eventos...<span>
					</div>
				</div>
				<div id="eventLiveListOffset0">
					<?php include_partial('home/resume/eventLive/eventList', array('offset'=>0, 'eventDate'=>null)) ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="loadEvents">
			<?php echo link_to('carregar mais eventos', '#loadMoreEventLives()') ?>
		</div>
		<div class="clear"></div>
	</div>