<?php
	sfContext::getInstance()->getResponse()->addStylesheet('commonBar');
?>
<a id="breadcrumb"></a>
<div class="commonBar">
	<div class="home" onclick="goToPage('home', 'index')"></div>
	<?php
		$i          = 0;
		$isLastPath = false;
		
		foreach($pathList as $pathName=>$link):
			$i++;
			
			if( $link ){
				
				$className = 'path link';
				
				if( preg_match('/^#/', $link) ){
					
					$link = preg_replace('/^#/', '', $link);
					$link = str_replace('"', '\'', $link);
					echo '<a href="javascript:void(0)" onclick="'.$link.'">';
				}else{
					
					echo '<a href="'.url_for($link).'">';
				}
			}else{
				
				$className = 'path';
			}
			
			if( $i==count($pathList) ){
				
				$className  .= ' last';
				$isLastPath = true;
			}
	?>
		<div class="<?php echo $className ?>"<?php echo ($isLastPath?' id="lastCommonBarPath"':'') ?> onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><?php echo $pathName ?></div>
	<?php
			if( $link )
				echo '</a>';
		endforeach;
	?>
	<div id="indicator">
		Processando, aguarde... <?php echo image_tag('ajaxLoader.gif', array('align'=>'absmiddle')) ?>
	</div>
</div>
<a id="topAlert"></a>
<div id="topSystemMessage">
	<?php
		$messageList = (isset($messageList)?$messageList:array());
		
		foreach($messageList as $message){
			
			$class = (preg_match('/^\?/', $message)?'help':(preg_match('/^\@/', $message)?'error':'info'));
			
			$message = preg_replace('/^[\?\!@]/', '', $message);
			echo '<div class="message '.$class.'">'.$message.'</div>';
		}
	?>
</div>
<div class="commonBarSpacer"></div>