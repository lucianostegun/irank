<style>
.handQuiz .options {

	float: 			left;
	position: 		relative;
	top: 			5px
}

.handQuiz .options .option {

	margin-top: 	2px;
	margin-left: 	3px;
	background: 	#F0F0F0 url('/images/quiz/optionBg.gif') repeat-x;
	padding: 		2px 4px 2px 8px;
	width: 			76px;
	
	border: 				1px solid #D0D0D0;
	-moz-border-radius: 	5px;
	-webkit-border-radius: 	5px;
	border-radius: 			5px;
}

.handQuiz .options .option.hover {

	background-position: 	0 -20px;
}

.handQuiz .options .option.selected {

	background-position: 	0 -40px;
	font-weight: 			bold;
}

.handQuiz .options .option a {

	color: 				#505050;
	text-decoration: 	none;
}
</style>
<h2>Enquete de mãos</h2>
<div class="handQuiz" style="position: relative; left: 0px; top: 0px; background: #FAFAFA; padding-top: 10px">
	<div style="margin: -2px 8px 5px 8px">Você é small blind e está abaixo da média na mesa. Qual sa sua ação?</div>
	<div class="image" style="float: left; margin: 5px"><?php echo image_tag('quiz/8Koff') ?></div>
	<div class="options">
		<div class="option"><?php echo link_to('CALL', '') ?></div>
		<div class="option"><?php echo link_to('RAISE', '') ?></div>
		<div class="option"><?php echo link_to('ALL IN', '') ?></div>
		<div class="option selected"><?php echo link_to('FOLD', '') ?></div>
	</div>
	<div class="clear"></div>
</div>