<?php
	echo form_remote_tag(array(
		'url'=>'ranking/savePlace',
		'success'=>'handleSuccessRankingPlace(request.responseText)',
		'failure'=>'handleFailureRankingPlace(request.responseText)',
		'encoding'=>'utf8',
		'loading'=>'showIndicator("rankingPlace")'
		), array('id'=>'rankingPlaceForm'));
	
	echo input_hidden_tag('rankingPlaceId', null, array('id'=>'rankingPlaceRankingPlaceId'));
	echo input_hidden_tag('rankingId', null, array('id'=>'rankingPlaceRankingId'));
?>
	<table width="100%" height="<?php echo $windowHeight-17 ?>" cellspacing="1" cellpadding="0" class="windowForm">
		<tr>
			<td valign="top">
				<div class="row">
					<div class="label" id="rankingPlacePlaceNameLabel"><?php echo __('ranking.placeName') ?></div>
					<div class="field"><?php echo input_tag('placeName', null, array('size'=>20, 'maxlength'=>20, 'class'=>'required', 'id'=>'rankingPlacePlaceName')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="rankingPlaceMapsLinkLabel"><?php echo __('ranking.mapsLink') ?></div>
					<div class="field"><?php echo input_tag('mapsLink', null, array('size'=>45, 'onblur'=>'parseMapsLinkInfo(this.value)', 'id'=>'rankingPlaceMapsLink')) ?></div>
					<div class="textFlex" id="rankingPlaceMapsLinkLoader"><?php echo image_tag('ajaxLoaderForm.gif') ?></div>
				</div>
				<div class="row">
					<div class="label" id="rankingPlaceStateIdLabel">Estado</div>
					<div class="field"><?php echo select_tag('stateId', State::getOptionsForSelect(), array('id'=>'rankingPlaceStateId')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="rankingPlaceCityNameLabel">Cidade</div>
					<div class="field"><?php echo input_tag('cityName', null, array('size'=>25, 'maxlength'=>32, 'id'=>'rankingPlaceCityName')) ?></div>
				</div>
				<div class="row">
					<div class="label" id="rankingPlaceQuarterLabel">Bairro</div>
					<div class="field"><?php echo input_tag('quarter', null, array('size'=>20, 'maxlength'=>32, 'id'=>'rankingPlaceQuarter')) ?></div>
				</div>
			</td>
		</tr>
	</table>
	<div class="windowButtonBar">
		<?php
			echo button_tag('rankingPlaceCancel', __('button.cancel'), array('onclick'=>'windowRankingPlaceAddHide(); rankingPlaceOnClose()'));
			echo button_tag('rankingPlaceSubmit', __('button.save'), array('onclick'=>'doSubmitRankingPlace()'));
			echo getFormWindowLoading('rankingPlace');
			echo getFormStatus('rankingPlace');
		?>
	</div>
</form>