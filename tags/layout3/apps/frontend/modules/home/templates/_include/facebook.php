<?php
	#echo link_to(image_tag('f_logo', array('style'=>'float: left; position: relative; top: 17px; left: 5px')), 'https://www.facebook.com/irankpoker', array('target'=>'_blank'))
	
	if( !Util::isDebug() ):
?>
<iframe id="facebookFrame" src="https://www.facebook.com/plugins/like.php?href=http://www.facebook.com/irankpoker&layout=button_count&show_faces=true&width=200&action=like&colorscheme=light&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
<?php endif; ?>