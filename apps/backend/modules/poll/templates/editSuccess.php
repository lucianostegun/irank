<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#pollForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('poll/tab/main', array('pollObj'=>$pollObj)) ?></div>
		</div>
	</div>
</div>
