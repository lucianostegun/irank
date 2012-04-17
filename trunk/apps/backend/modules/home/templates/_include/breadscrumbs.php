    <div class="topNav toolbarNav" style="top: 30px">
        <div class="wrapper">
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
            <div class="userNav">
            </div>
            <div class="userNav">
                <ul>
                    <li><?php echo link_to(image_tag('backend/toolbar/new').'<span>Novo</span>', '#doGetNew()') ?></li>
                    <li><?php echo link_to(image_tag('backend/toolbar/save').'<span>Salvar</span>', '#doSaveMain()') ?></li>
                    <li><?php echo link_to(image_tag('backend/toolbar/delete').'<span>Excluir</span>', '#doDeleteMain()') ?></li>
                </ul>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>