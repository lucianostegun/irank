<?php
	echo form_tag('userAdmin/save', array('class'=>'form', 'id'=>'userAdminForm'));
	
	echo input_hidden_tag('userAdminId', $userAdminObj->getId());
	echo input_hidden_tag('password', $userAdminObj->getPassword(), array('id'=>'userAdminPassword'));
?>
<!-- Fullscreen tabs -->
<div class="widget">    
    <ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
	</ul>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('userAdmin/tab/main', array('userAdminObj'=>$userAdminObj)) ?></div>
    </div>	
    <div class="clear"></div>		 
</div>
</form>