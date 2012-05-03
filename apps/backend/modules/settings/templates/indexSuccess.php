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
	<div class="widget">       
		<?php
			echo form_remote_tag(array(
				'url'=>'settings/save',
				'success'=>'handleSuccessSettings(response)',
				'failure'=>'handleFailureSettings(response.responseText)',
				),
				array('class'=>'form', 'id'=>'settingsForm'));
	//		echo form_tag('settings/save', array('class'=>'form', 'id'=>'settingsForm'));
			
			include_partial('settings/tab/main', array('genericObj'=>$genericObj));
		?>
		</form>
	</div>
</div>
