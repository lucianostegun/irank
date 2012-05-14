    <div class="wrapper">
        <div class="pageTitle">
        	<h5>Painel de controle</h5>

        	<span>
        		O painel de controle permite que você personalize alguns parâmetros para utilização das ferramentas de administração.<br/>
        		As configurações alteradas aqui afetarão o uso de todos os usuários do clube.
        	</span>
    	</div>
        <div class="clear"></div>
    </div>
    <div class="line"></div>    
    <div class="wrapper">
    	<!-- Title area -->
    	<div class="clear"></div>
	</div>
	
<div class="wrapper">
	
	<!-- Fullscreen tabs -->
    <div class="widget form">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Templates</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#settingsForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<?php
				echo form_remote_tag(array(
					'url'=>'settings/save',
					'success'=>'handleSuccessSettings(response)',
					'failure'=>'handleFailureSettings(response.responseText)',
					'loading'=>'showIndicator()',
					),
					array('class'=>'form', 'id'=>'settingsForm'));
		//		echo form_tag('settings/save', array('class'=>'form', 'id'=>'settingsForm'));
			?>
			<div id="tab1" class="tab_content"><?php include_partial('settings/tab/main', array('genericObj'=>$genericObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('settings/tab/template', array('genericObj'=>$genericObj)) ?></div>
			</form>
		</div>
	</div>
</div>