<?php
	echo form_remote_tag(array(
		'url'=>'userAdmin/save',
		'success'=>'handleSuccessUserAdmin(request.responseText)',
		'failure'=>'handleFailureUserAdmin(request.responseText)',
		'loading'=>'showIndicator("userAdmin")',
		'encoding'=>'UTF8',
	), array('id'=>'userAdminForm'));
	
	echo input_hidden_tag('userAdminId', $userAdminObj->getId());
	echo input_hidden_tag('password', $userAdminObj->getPassword(), array('id'=>'userAdminPassword'));
?>
	<article class="module width_form">
	<header>
		<h3 class="tabs_involved" id="mainRecordName"><?php echo $userAdminObj->toString() ?></h3>
	<ul class="tabs">
		<li><a href="#tab1">Principal</a></li>
	</ul>
	</header>
	<?php include_partial('home/include/formHeader', array('prefix'=>'userAdmin')) ?>
	<div class="tab_container">
		<div id="tab1" class="tab_content"><?php include_partial('userAdmin/tab/main', array('userAdminObj'=>$userAdminObj)) ?></div>
	</div>
<?php include_partial('home/include/formFooter', array('prefix'=>'userAdmin')) ?>
</article><!-- end of content manager article -->
</form>