<style>

.eventDetailsArea {

    background: 			-moz-linear-gradient(top, #FFFFFF, #DFDFDF);
    background: 			-webkit-gradient(linear, left top, left bottom, from(#FFFFFF), to(#DFDFDF));
    filter: 				progid:DXImageTransform.Microsoft.Gradient(StartColorStr='#FFFFFF', EndColorStr='#DFDFDF', GradientType=0);
    min-height: 			400px;	
}

.eventDetailsArea .separator {

	clear: 			both;
	width: 			100%;
	border-top: 	1px solid #DDDDDD;
	border-bottom: 	1px solid #FFFFFF;
	margin-top: 	10px;
	margin-bottom: 	7px;
}

.eventDetails {
	
	margin: 	10px 10px 0px 10px;
}

.eventDetails .logo {

	width: 			110px;
	text-align: 	center;	
}

.eventDetails h1 {

	font-size: 		18px;
	margin: 		0px;
	padding: 		0px;
	font-weight: 	bold;
	font-family: 	Verdana, Sans serif;
	text-align: 	left;
	text-shadow: 	silver 1px 1px;	
}

.eventDetails .info td {

	font-size: 		13px;
	padding-left: 	15px;	
}

.eventDetails .payInfo {

	text-align: 		center;
	vertical-align: 	top;
	width: 				250px;
}

.eventDetails .payInfo table {
	
	width: 	200px;
}

.eventDetails .payInfo table tr th {
	
}

.eventDetails .payInfo table tr td {
	
	white-space: 	nowrap;
	padding-top: 	8px;
	text-align: 	center;
	font-weight: 	bold;
}

.eventDetails .payInfo table tr td.presence {
	
	padding: 	15px 0px 0px 35px;	
}


.eventDetailsArea .channel td {

	clear: 				both;
	border-left: 		1px solid #D0D0D0;
	border-right: 		1px solid #FFFFFF;
	margin-top: 		10px;
	margin-bottom: 		7px;
	height: 			40px;
	text-align: 		center;
	font-size: 			18px;
	font-family: 		Arial;
	font-weight: 		bold;
	text-shadow: 		white 1px 1px;
	color: 				#A0A0A0;
	padding: 			0px 15px 0px 15px;
}

.eventDetailsArea .channel td.first {

	border-left: 	none;	
}

.eventDetailsArea .channel td.last {

	border-right: 	none;	
}

.eventDetailsArea .channel td.active {

	color: 		#303030;	
}

.eventDetailsArea #eventInfo {
	
	margin: 		25px;
	font-size: 		12px;
	text-align: 	left;
	text-shadow: 	white 1px 1px;	
}
</style>

<?php include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index', 'Vegas Holdem Club'=>null, 'Super Terça Odds Brasil'=>null, 'Super Terça Dia 1A'=>null))); ?>
<div class="eventDetailsArea" align="center">
	<table cellspacing="0" cellpadding="0" width="100%" class="eventDetails">
		<tr>
			<td rowspan="5" class="logo"><?php echo image_tag('temp/odds.jpg') ?></td>
		</tr>
		<tr>
			<th valign="top"><h1>Super Terça com 25K Garantidos by Odds Brasil - Dia 1A</h1></th>
			<td class="payInfo" align="center" rowspan="5">
				<div align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<th><?php echo image_tag('event/coins') ?></th>
						<th><?php echo image_tag('event/timer') ?></th>
						<th><?php echo image_tag('event/chips') ?></th>
						<th><?php echo image_tag('event/players') ?></th>
					</tr>
					<tr>
						<td>1500,00</td>
						<td>01:00</td>
						<td>12.000</td>
						<td>45</td>
					</tr>
					<tr>
						<td colspan="4" class="presence"><?php echo button_tag('confirmPresence', 'CONFIRMAR PRESENÇA') ?></td>
					</tr>
				</table>
				</div>
			</th>
		</tr>
		<tr class="info">
			<td>Terça-feira, 20/03/2012 - 20:00</th>
		</tr>
		<tr class="info">
			<td><?php echo link_to('@Vegas Holdem Club - Jardim Ibirapuera - SP', '') ?></th>
		</tr>
	</table>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td class="first active">Informações</td>
			<td>Resultado</td>
			<td>Premiação</td>
			<td>Fotos</td>
			<td class="last">Ranking</td>
		</tr>
	</table>
	<div class="separator"></div>
	
	<div id="eventInfo">
		*EVENTO PRINCIPAL<br/>
		<br/>
		- Dia 1A: sexta – 16/03 às 21H<br/>
		- Dia 1B: sábado – 17/03 às 17h<br/>
		- Dia 2 : Domingo - 18/03 às 15h<br/>
		- Dia Final: Segunda - 19/03 às 21h<br/>
		- BuyIn: R$ 800,00 (25.000 fichas)<br/>
		- Blinds: 40min<br/>
		<br/>
		*ESTRUTURA<br/>
		<br/>
		A estrutura do CPH foi modificada ao longo da temporada 2011 e, com o aval dos jogadores, chegou a um formato que garante uma disputa técnica e favorece a habilidade do competidor. A Nutzz Eventos verificou que ainda há espaço para melhorar e, então, para 2012, o stack inicial será aumentado para 25.000 fichas.<br/>
		Além disso, o buy-in será aumentado para R$ 800,00 (700 + 100) e as re-entradas serão modificadas: agora um jogador eliminado no dia 1A poderá se inscrever novamente no dia 1B, mas a recompra no mesmo dia inicial – o famoso “Double chance” – não existirá mais.<br/>
		<br/>
		<br/>
		*RANKING<br/>
		<br/>
		Seguindo o modelo que o BSOP irá adotar em 2012, haverá uma tabela de pontuação fixa, com variações para o número de participantes.<br/>
		A premiação para o campeão, vice e terceiro lugar também mudou. Em vez de proporcionar ao ganhador a chance de jogar um único torneio, a premiação dará várias chances aos campeões:<br/>
		1. Buyins para a temporada 2013 completa do CPH e mais três buyins do BSOP 2013;<br/>
		2. Buyins para 7 etapas do CPH 2013 e mais dois buyins do BSOP 2013;<br/>
		<br/>
		*Para se inscrever:<br/>
		<br/>
		Deposite o valor da inscrição<br/>
		Para garantir sua vaga, evitar filas e confirmar sua inscrição, faça um depósito na conta que segue no valor de R$800,00 (procure depositar com alguma identificação – ex: centavos a mais, etc...)<br/>
		<br/>
		Nutzz Eventos Ltda. ME<br/>
		Banco Itaú<br/>
		Ag 2976<br/>
		CC 09959-4<br/>
		CNPJ: 08.021.507/0001-33<br/>
		<br/>
		Após realizar o depósito envie e-mail para contato@circuitoholdem.com.br com seu nome completo, documento de identidade, CPF, telefone e e-mail de contato, dia em que quer jogar e o comprovante de depósito.<br/>
		<br/>
		H2 Club - A casa do Texas Holdem e Omaha de São Paulo<br/>
		Rua Iguatemi Nº:236 TEL:3078-5884 / 3074-0090<br/>
	</div>
...<br/><br/>
</div>

