<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Acessos</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#userAdminForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('userAdmin/tab/main', array('userAdminObj'=>$userAdminObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('userAdmin/tab/accessLog', array('userAdminObj'=>$userAdminObj)) ?></div>
	    </div>	
	    <div class="clear"></div>		 
	</div>
</div>
