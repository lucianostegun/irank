<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Agenda'=>'eventLive/index', 'Sincronização'=>'schedule/index', 'iOS'=>null)));
?>
<?php echo image_tag('schedule/ios', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Para sincronizar o calendário de seu iPhone, iPad ou iPod touch com a agenda <b>iRank</b>, siga os passos abaixo.<br/><br/>
	
	<?php echo link_to('Entre em contato', 'contact/index') ?> caso esteja encontrando alguma dificuldade na configuração.
	<!--Saiba também como configurar seu smartphone ou tablet com <?php echo link_to('android', 'schedule/android') ?>.-->
</div>
<hr class="separator"/>

<div id="stepPaginator">
	<?php
		echo button_tag('navigatorPrevious', 'Anterior', array('image'=>'previous.png', 'onclick'=>'showPrevious()', 'disabled'=>true));
		echo button_tag('navigatorNext', 'Próximo', array('image'=>'next.png', 'onclick'=>'showNext()'));
	?>
</div>
<div id="stepResetPaginator">
	<?php echo button_tag('navigatorReset', 'Reiniciar', array('image'=>'reload.png', 'onclick'=>'resetSteps()')) ?>
</div>

<div class="steps">
	<div id="step-001" class="step">
		<div class="image"><?php echo image_tag('schedule/ios/001') ?></div>
		<div class="info">
			<h1>1/8 <div class="title">Ajustes</div></h1>
				<div class="instructions"><p>Em <b>Ajustes</b> selecione a opção <b>Mail, Contatos, Calendários</b>.</p></div>
		</div>
	</div>
	<div id="step-002" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/002') ?></div>
		<div class="info">
			<h1>2/8 <div class="title">Adicionar conta</div></h1>
				<div class="instructions"><p>No grupo <b>Contas</b> selecione a opção <b>Adicionar Conta...</b></p></div>
		</div>
	</div>
	<div id="step-003" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/003') ?></div>
		<div class="info">
			<h1>3/8 <div class="title">Outra</div></h1>
				<div class="instructions"><p>Selecione a opção <b>Outra</b>.</p></div>
		</div>
	</div>
	<div id="step-004" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/004') ?></div>
		<div class="info">
			<h1>4/8 <div class="title">Calendário assinado</div></h1>
				<div class="instructions"><p>Selecione a opção <b>Adicionar Calendário Assinado</b>.</p></div>
		</div>
	</div>
	<div id="step-005" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/005') ?></div>
		<div class="info">
			<h1>5/8 <div class="title">Assinatura</div></h1>
				<div class="instructions"><p>No campo <b>Servidor</b> digite o endereço da agenda:<br/><br/><center><b>agenda.irank.com.br</b></p></div>
		</div>
	</div>
	<div id="step-006" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/006') ?></div>
		<div class="info">
			<h1>6/8 <div class="title">Confirmação</div></h1>
				<div class="instructions"><p>Você será informado de que a assinatura do calendário requer uma autenticação.</p><p>Apenas toque no botão <b>OK</b>.</p></div>
		</div>
	</div>
	<div id="step-007" class="step hidden">
		<div class="image"><?php echo image_tag('schedule/ios/007') ?></div>
		<div class="info">
			<h1>7/8 <div class="title">Autenticação</div></h1>
				<div class="instructions">
					<p>No campo <b>Nome de usuário</b> informe o seu nome de usuário caso já seja cadastrado no site. Se ainda não é cadastrado utilize o usuário <b><i>irank</i></b>.</p>
					<p>No campo <b>Senha</b> informe a senha padrão <b><i>irank</i></b>.</p>
					<p>Desabilite a opção <b>Usar SSL</b>.</p>
					<p>Caso queira apenas sincronizar a agenda e não ser notificado dos eventos, marque a opção <b>Remover alarmes</b>.</p>
					<p>Toque no botão <b>Salvar</b>.</p>
					<p>&nbsp;</p>
					<p><i>Obs: Não utilize seu e-mail no campo <b>Nome de usuário</b>.</p><p>Após assinar o calendário você poderá trocar a senha padrão para uma senha de sua preferência.</i></p>
				</div>
		</div>
	</div>
	<div id="step-008" class="step hidden last">
		<div class="info">
			<h1><?php echo image_tag('success') ?><div class="title">Pronto!</div></h1>
				<div class="instructions"><p>Agora você terá todos os eventos de seus rankings e dos clubes próximos a você sempre atualizados em seu calendário.</p><p>Aproveite!</p></div>
		</div>
		<div class="clear"></div>
		<div class="image"><?php echo image_tag('schedule/ios/009') ?></div>
		<div class="image"><?php echo image_tag('schedule/ios/010') ?></div>
	</div>
	<div class="clear"></div>
</div>
<script>
	setupSteps(8)
</script>