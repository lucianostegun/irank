<style>
.cashTable {
	width: 737px;
	height: 438px;
	position: relative;
	left: -369px;
	margin-left: 50%;
	margin-top: 30px;
	background: url('/images/backend/cashTable/tableLarge.png') no-repeat;
}

.cashTable .seat {
	
	position: 	absolute;
	width: 		150px;
	height: 	42px;
	cursor: 	pointer;
}

.cashTable .seat label {
	
	display: 			table-cell;
	position: 			absolute;
	top: 				3px;
	left: 				10px;
	color: 				#FBFBFB;
	width: 				130px;
	height: 			42px;
	text-align: 		center;
	cursor: 			pointer;
	font-weight: 		bold;
	text-transform: 	uppercase;
	overflow: 			hidden;
	white-space: 		nowrap;
	z-index: 			3;
}

.cashTable .seat.empty label {
	
	top: 				10px;
	text-transform: 	uppercase;
	color: 				#FFBA00;
	text-shadow: 		#000000 1px 1px
}

.cashTable .seat span.bankRoll {
	
	display: 		table-cell;
	position: 		absolute;
	top: 			23px;
	color: 			#B0B0B0;
	width: 			150px;
	height: 		42px;
	text-align: 	center;
	font-size: 		12px;
	cursor: 		pointer;
	z-index: 		2;
}

.cashTable .seat.empty span.bankRoll {
	
	display: 		none;
}

.cashTable .seat span.position {
	
	position: 		absolute;
	color: 			#FBFBFB;
	text-align: 	left;
	font-size: 		13px;
	line-height: 	14px;
	padding: 		1px 4px 1px 5px;
	border-radius: 	10px;
	background: 	#101010;
	border: 		1px solid #606060;
	font-weight: 	bold;
	z-index: 		1;
}

.cashTable #seat-1 {left: 486px; top: 53px}
.cashTable #seat-2 {left: 553px; top: 123px}
.cashTable #seat-3 {left: 583px; top: 195px}
.cashTable #seat-4 {left: 533px; top: 275px}
.cashTable #seat-5 {left: 395px; top: 334px}
.cashTable #seat-6 {left: 200px; top: 334px}
.cashTable #seat-7 {left: 62px; top: 275px}
.cashTable #seat-8 {left: 4px; top: 195px}
.cashTable #seat-9 {left: 42px; top: 123px}
.cashTable #seat-10 {left: 101px; top: 53px}

.cashTable #seat-1 span.position,
.cashTable #seat-2 span.position,
.cashTable #seat-3 span.position,
.cashTable #seat-4 span.position,
.cashTable #seat-5 span.position {bottom: -5px; left: 0px}

.cashTable #seat-6 span.position,
.cashTable #seat-7 span.position,
.cashTable #seat-8 span.position,
.cashTable #seat-9 span.position,
.cashTable #seat-10 span.position {bottom: -5px; right: 0px}

#cashTablePeoplePicture {
	
	width: 			135px;
	height: 		180px;
	border: 		1px solid #909090;
	margin-top: 	10px;
	background: 	url('/images/backend/cashTable/unavailable.png') no-repeat;
}

table .formRow .formRight {
	
	width: 200px;
}

table .formRow label {
	
	font-weight: bold;
}

table .formRow .formRight label {
	
	position: relative;
	top: 0px;
	font-size: 12px;
	font-weight: normal;
}

table .formRow .formRight input {
	
	width: auto;
	text-align: left;
	margin: 0px
}

#dialog-message a {
	
	color: 	#325F9B;
	font-size: 11px
}

#dialog-message a img {
	
	position: relative; top: 3px
}
</style>

<script>
function togglePlayer(position){
	
	$('#dialog-message').dialog('open');
	_tablePosition = position;
	
	clearFormFieldErrors('cashTablePlayerSelect');
	
	$('#cashTablePlayerSelectPeopleId').val('');
	$('#cashTablePlayerSelectPeopleName').val('');
	$('#cashTablePlayerSelectBuyin').val('');
	$('#cashTablePlayerSelectPosition').html(position);
}

function doSelectCashTablePlayer(peopleId, peopleName){
	
	$('#cashTablePlayerSelectPeopleId').val(peopleId);
	// carregar aqui as informações do jogador
}
</script>

<div class="cashTable">
	<?php for($position=1; $position <= 10; $position++): ?>
	<div class="seat empty" onclick="togglePlayer(<?php echo $position ?>)" id="seat-<?php echo $position ?>"><label id="playerName-<?php echo $position ?>">Vazio</label><span class="bankRoll" id="bankRoll-<?php echo $position ?>"><?php echo Util::formatFloat(0, true) ?></span><span class="position"><?php echo $position ?></span></div>
	<?php endfor; ?>
</div>

<div class="uDialog">
    <div id="dialog-message" title="Inclusão de jogador">
        <p>Informe o nome ou e-mail do jogador que deseja incluir na posição <span id="cashTablePlayerSelectPosition"></span>.</p>
        
        <form class="form" id="cashTablePlayerSelectForm" onsubmit="addPlayer(); return false">
        <table>
        	<tr>
        		<td style="width: 145px">
        			<div id="cashTablePeoplePicture"></div>
        			<a href="javascript:void(0)" onclick=""><img src="/images/backend/icons/editTop.png" class="mt5 mr5">Editar informações</a>
        		</td>
        		<td style="width: 340px; vertical-align: top; text-align: center">
	        		<div class="formRow">
			        		<?php
			        			echo input_autocomplete_tag('pepleName', null, 'people/autoComplete?instanceName=players', 'doSelectCashTablePlayer', array('size'=>'100%', 'style'=>'font-size: 16px; font-weight: bold', 'maxlength'=>200, 'id'=>'cashTablePlayerSelectPeopleName'));
			        			echo input_hidden_tag('peopleId', null, array('id'=>'cashTablePlayerSelectPeopleId'));
			        		?>
			        		<div class="formNote error" id="cashTablePlayerSelectFormErrorPeopleName"></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>Buyin</label>
						<div class="formRight">
							<?php echo input_tag('buyin', 0, array('size'=>8, 'maxlength'=>8, 'class'=>'textR', 'id'=>'cashTablePlayerSelectBuyin')); ?>
							<div class="formNote error" id="cashTablePlayerSelectFormErrorBuyin"></div>
						</div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>E-mail</label>
						<div class="formRight"><label>lucianostegun@gmail.com</label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow">
						<label>Telefone</label>
						<div class="formRight"><label>(11) 8030-2030</label></div>
						<div class="clear"></div>
	        		</div>
	        		
	        		<div class="formRow">
						<label>Último jogo</label>
						<div class="formRight"><label>(primeira vez)</label></div>
						<div class="clear"></div>
	        		</div>

	        		<div class="formRow">
						<label>Restrição</label>
						<div class="formRight"><label>Nenhuma</label></div>
						<div class="clear"></div>
	        		</div>
        		</td>
        	</tr>
        </table>
        <?php echo submit_image_tag('blank.gif', array('class'=>'invisible')); ?>
        </form>
    </div>
</div>