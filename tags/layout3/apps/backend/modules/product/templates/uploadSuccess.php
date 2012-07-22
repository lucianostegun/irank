<?php
	echo form_tag('product/uploadLogo', array('enctype'=>'multipart/form-data'));
	echo input_hidden_tag('productId', $productId);
	echo input_hidden_tag('userAdminId', 1);
	echo input_file_tag('Filedata');
	echo submit_tag('Enviar');
?>