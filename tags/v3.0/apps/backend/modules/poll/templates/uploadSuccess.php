<div class="wrapper">
    <div class="widget">
	<?php
		echo form_tag('poll/uploadImage', array('enctype'=>'multipart/form-data'));
		echo input_hidden_tag('pollId', $pollId);
		echo input_hidden_tag('userAdminId', 1);
		echo input_file_tag('Filedata');
		echo submit_tag('Enviar');
	?>
	</div>
</div>