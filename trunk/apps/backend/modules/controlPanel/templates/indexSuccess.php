<div class="wrapper">
	<!-- Fullscreen tabs -->
	<div class="widget">       
		<ul class="tabs">
			<li><a href="#tab1">E-mail</a></li>
			<li><a href="#tab2">Diretórios</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#controlPanelForm").submit()')); ?>
		</ul>
		<?php
			echo form_remote_tag(array(
				'url'=>'controlPanel/save',
				'success'=>'handleSuccessControlPanel(response)',
				'failure'=>'handleFailureControlPanel(response.responseText)',
				),
				array('class'=>'form', 'id'=>'controlPanelForm'));
	//		echo form_tag('controlPanel/save', array('class'=>'form', 'id'=>'controlPanelForm'));
		?>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('controlPanel/tab/email', array()) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('controlPanel/tab/paths', array()) ?></div>
		</div>
		</form>
	</div>
</div>
