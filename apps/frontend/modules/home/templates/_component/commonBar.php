<?php
	sfContext::getInstance()->getResponse()->addStylesheet('commonBar');
?>
<div class="commonBar">
	<div class="home" onclick="goToPage('home', 'index')"></div>
	<?php
		$i = 0;
		foreach($pathList as $pathName=>$link):
			$i++;
			
			if( $link ){
				
				$className = ($i==count($pathList)?'path link last':'path link');
				
				if( preg_match('/^#/', $link) ){
					
					$link = preg_replace('/^#/', '', $link);
					$link = str_replace('"', '\'', $link);
					echo '<a href="javascript:void(0)" onclick="'.$link.'">';
				}else{
					
					echo '<a href="'.url_for($link).'">';
				}
			}else{
				
				$className = ($i==count($pathList)?'path last':'path');
			}
	?>
		<div class="<?php echo $className ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><?php echo $pathName ?></div>
	<?php
			if( $link )
				echo '</a>';
		endforeach;
	?>
</div>
<div class="commonBarSpacer"></div>