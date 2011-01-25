<div class="commonBar"><span>Home</span></div>
    
<table border="0" cellspacing="0" cellpadding="0" class="welcome">
	<tr>
		<td width="245" align="left" bgcolor="#173211">
			<?php echo image_tag('frontend/layout/welcome_img.jpg') ?>
		</td>
		<td align="left" valign="top" style="padding:0px 10px 0px 21px; color: #DADADA" bgcolor="#173211">
			<p><?php echo image_tag($culture.'/layout/welcome') ?>
        	<?php echo image_tag('frontend/layout/welcomeLogo', array('align'=>'right')) ?></p>
        	
        	<?php echo __('home.welcome', array('%link%'=>link_to(__('clickHere'), 'sign', array('class'=>'white', 'style'=>'font-weight: bold; color: #FFFFFF')))) ?>
		</td>
	</tr>
</table>