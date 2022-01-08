<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Disco virtual</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#blogForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('blog/tab/main', array('blogObj'=>$blogObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('blog/tab/fileManager', array('blogObj'=>$blogObj)) ?></div>
		</div>
	</div>
</div>
