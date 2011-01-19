<div class="commonBar"><span>Pesquisa de jogadores e eventos</span></div>
<div class="innerContent">
	<?php echo image_tag('layout/search', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Quer encontrar seus amigos e incluí-los em seus rankings?<br/>
	Simples, você pode localizar usuários já cadastrados no site pesquisando
	pelo username ou e-mail do jogador.<br/><br/>
	E lembre-se, caso você não os encontre você pode convidá-los para juntar-se a você
	em seus eventos.<br/><br/>

	Procurando jogadores e eventos em rankings abertos.<br/>
	<b><?php echo link_to('Clique aqui', 'search/advanced') ?></b> para fazer uma pesquisa avançada.  
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th colspan="3">Resultado da pesquisa</td>
	</tr>
	<?php if( count($userSiteObjList) ): ?>
	<tr class="header">
		<th>Username</th>
		<th>E-mail</th>
		<th>Membro desde</th>
	</tr>
	<?php endif; ?>
	<?php include_partial('search/include/search', array('userSiteObjList'=>$userSiteObjList)); ?>
</table>
<div class="tabbarFooterInfo">* As pesquisas são limitadas a 20 resultados e não exibem o e-mail completo do usuário</div>