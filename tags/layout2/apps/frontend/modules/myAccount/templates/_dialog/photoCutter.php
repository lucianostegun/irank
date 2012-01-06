<?php
	echo form_tag('', array('id'=>'photoCutterForm'));
	echo input_hidden_tag('x1', null, array('id'=>'photoCropX1'));
	echo input_hidden_tag('y1', null, array('id'=>'photoCropY1'));
	echo input_hidden_tag('x2', null, array('id'=>'photoCropX2'));
	echo input_hidden_tag('y2', null, array('id'=>'photoCropY2'));
	echo input_hidden_tag('width', null, array('id'=>'photoCropWidth'));
	echo input_hidden_tag('height', null, array('id'=>'photoCropHeight'));
?>
</form>
<div id="photoCutterDiv" style="height: <?php echo $windowHeight-17 ?>px">
		<img src="" id="imageCrop" />
</div>
<div class="windowButtonBar">
	<?php
		echo button_tag('cancelPhotoCutter', __('button.cancel'), array('onclick'=>'closePhotoCutter()'));
		echo button_tag('savePhotoCutter', __('button.save'), array('onclick'=>'doSavePhotoCutter()'));
		echo getFormWindowLoading('photoCutter');
	?>
</div>