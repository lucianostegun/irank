<h1>Concluído!</h1>

<div class="defaultForm">

	<div style="padding-left: 155px; background: url('/images/ok128.png') no-repeat 10px 20px; width: 500px; height: 200px">
		A configuração do seu timer foi concluída com sucesso!<br/>
		Clique em <b>Visualizar</b> para abrir o timer em outra tela*.<br/><br/>
		Você também pode criar outras configurações de tempo para outros torneios e/ou eventos, e eles ficarão disponíveis em sua conta.<br/><br/>
		<hr/>
		<div class="ml20">
		<?php
			echo button_tag('openTimer', 'Visualizar', array('onclick'=>'openTimer('.$timerId.')', 'image'=>'arrowRight'));
			echo button_tag('showTimerList', 'Lista de configurações', array('onclick'=>'showTimerList()', 'image'=>'list'));
		?>
		</div>
		<div class="clear"></div>
		<hr/>
		<i>*Verifique se o bloqueio de pop-up está ativo caso a janela do timer não abra.</i>
	</div>
</div>