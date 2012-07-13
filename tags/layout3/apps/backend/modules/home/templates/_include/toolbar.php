<style>
.toolbar {
	display: block;
	color: #eeeeee; position: fixed;
	width: 84.33%;
	z-index: 99;
	background: url(/images/backend/backgrounds/bg.jpg); 
}
</style>

<div class="toolbar">
    <div class="line mt20"></div>
	<div class="breadcrumbs_container">
		<article class="breadcrumbs2">
		<?php
			$pathList = (isset($pathList)?$pathList:array());
			echo link_to('Home', 'home/index');
			
			$key = 0;
			foreach($pathList as $pathName=>$pathLink){
				
				$key++;
				
				echo '<div class="breadcrumb_divider"></div>';
				echo link_to($pathName, $pathLink, array('class'=>($key==count($pathList)?'last':''), 'id'=>($key==count($pathList)?'lastPathName':'')));
			}
		?>
		</article>
	</div>
	<div class="horControlT" style="height: 37px">
    	<ul>
            <?php
            	if( in_array('new', $toolbarList) )
            		echo '<li>'.link_to(image_tag('backend/toolbar/new').'<span>Novo</span>', '#doGetNew()').'</li>';
            	
            	if( array_key_exists('save', $toolbarList) || in_array('save', $toolbarList) )
					echo '<li>'.link_to(image_tag('backend/toolbar/save').'<span>Salvar</span>', '#doSaveMain()').'</li>';
					
            	if( array_key_exists('delete', $toolbarList) || in_array('delete', $toolbarList) ){
            		
            		$executeAction = array_key_exists('delete', $toolbarList)?$toolbarList['delete']:'#doDeleteMain()';
					echo '<li>'.link_to(image_tag('backend/toolbar/delete').'<span>Excluir</span>', $executeAction).'</li>';
            	}
            	
//            	foreach($toolbarList as $toolbar)
//            		echo '<li>'.link_to(image_tag('backend/toolbar/'.$toolbar['image']).'<span>'.$toolbar['label'].'</span>', $toolbar['url']).'</li>';
			?>
        </ul>
    </div>
    <div class="line"></div>
</div>