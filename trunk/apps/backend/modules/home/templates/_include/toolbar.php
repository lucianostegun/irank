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
            <?php if( in_array('new', $toolbarList)): ?><li><?php echo link_to(image_tag('backend/toolbar/new').'<span>Novo</span>', '#doGetNew()') ?></li><?php endif; ?>
            <?php if( in_array('save', $toolbarList)): ?><li><?php echo link_to(image_tag('backend/toolbar/save').'<span>Salvar</span>', '#doSaveMain()') ?></li><?php endif; ?>
            <?php if( in_array('delete', $toolbarList)): ?><li><?php echo link_to(image_tag('backend/toolbar/delete').'<span>Excluir</span>', '#doDeleteMain()') ?></li><?php endif; ?>
        </ul>
    </div>
    <div class="line"></div>
</div>