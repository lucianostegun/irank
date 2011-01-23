<?php
	echo form_remote_tag(array(
		'url'=>'ranking/savePlace',
		'success'=>'handleSuccessRankingPlace( request.responseText )',
		'failure'=>'enableButton("rankingPlaceSubmit"); handleFormFieldError( request.responseText, "rankingPlaceForm", "rankingPlace", false, "rankingPlace" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator("rankingPlace")'
		), array( 'id'=>'rankingPlaceForm' ));
	
	echo input_hidden_tag('rankingPlaceId', null, array('id'=>'rankingPlaceRankingPlaceId'));
	echo input_hidden_tag('rankingId', null, array('id'=>'rankingPlaceRankingId'));
?>
	<table width="100%" height="<?php echo $windowHeight-17 ?>" cellspacing="1" cellpadding="0" class="windowForm">
		<tr>
			<td valign="top">
				<div class="row">
					<div class="label" id="rankingPlacePlaceNameLabel">Nome do local</div>
					<div class="field"><?php echo input_tag('placeName', null, array('size'=>20, 'maxlength'=>20, 'class'=>'required', 'id'=>'rankingPlacePlaceName')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="rankingPlaceMapsLinkLabel">Link GoogleMaps</div>
					<div class="field"><?php echo input_tag('mapsLink', null, array('size'=>60, 'id'=>'rankingPlaceMapsLink')) ?></div>
				</div>
			</td>
		</tr>
	</table>
	<div class="windowButtonBar">
		<?php
			echo button_tag('rankingPlaceCancel', 'Cancelar', array('onclick'=>'windowRankingPlaceAddHide()'));
			echo button_tag('rankingPlaceSubmit', 'Salvar', array('onclick'=>'doSubmitRankingPlace()'));
			echo getFormWindowLoading('rankingPlace');
			echo getFormStatus('rankingPlace');
		?>
	</div>
</form>