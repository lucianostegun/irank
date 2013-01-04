<div id="userResume" class="<?php echo ($isAuthenticated?'logged':'') ?>">
<?php
	if( $isAuthenticated ){
		
		include_partial('home/resume/events');
		include_partial('home/resume/quickResume');
	}
	
	Util::lightbox();
?>
<div class="clear"></div>
</div>
<div style="float: left">
<?php include_partial('home/include/highlight') ?>
<?php include_partial('blog/include/highlight'); ?>
</div>

<div class="rightBar">
	<?php
		include_partial('store/include/offerHome');
//		include_partial('ranking/include/public');
		include_partial('home/include/channels');
	?>
</div>

<div class="clear"></div>

<?php #include_partial('home/include/photoContest'); ?>

<div class="clear"></div>




<br/>