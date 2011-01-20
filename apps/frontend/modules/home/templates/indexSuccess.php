<div id="homeTopContentDiv">
<?php
	$isLogged = true;
	
	if( MyTools::isAuthenticated() )
		include_partial('home/component/resume');
	else
		include_partial('home/component/welcome');
?>
</div>


<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr>
		<td valign="top" width="490">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="homeDistinct">
				<tr>
					<th valign="top"><?php echo image_tag('layout/stats.png', array('align'=>'left')) ?></th>
					<td>
						<span>Estatísticas</span><br/>
						Gere gráficos de gastos, lucros, balanço e desempenho dos jogadores.
					</td>
					
					<td rowspan="3" class="separator"></td>

					<th valign="top"><?php echo image_tag('layout/event.png', array('align'=>'left')) ?></th>
					<td>
						<span>Notificação de eventos</span><br/>
						Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
					</td>
				</tr>
				<tr>
					<td colspan="2" class="separator"></td>
				</tr>
				<tr>
					<th valign="top"><?php echo image_tag('layout/photo.png', array('align'=>'left')) ?></th>
					<td>
						<span>Mural de fotos</span><br/>
						Compartilhar os melhores momentos dos eventos postando suas fotos no mural.
					</td>

					<th valign="top"><?php echo image_tag('layout/rankingHistory.png', array('align'=>'left')) ?></th>
					<td>
						<span>Histórico</span><br/>
						Histórico de posições, total gastos, prêmios e tudo sobre os rankings nas datas que houveram eventos.
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
		<div style="width: 275px; margin-left: 15px">
		<?php echo image_tag('iphone', array('align'=>'right', 'style'=>'margin-left: 10px')) ?>
		<p align="right"><span style="font-size: 11pt; font-weight: bold; color: #b61515">iRank Mobile</span><br/><br/>
		Conheça a versão móvel do site.<br/>
		Lá você encontra tudo sobre rankings além de poder<br/>
		postar o resultado dos eventos em tempo real.</p>
		</div>
		</td>
	</tr>
</table>
