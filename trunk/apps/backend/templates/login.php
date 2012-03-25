<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php
include_http_metas();
include_metas();
include_title();
?>
</head>
<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><?php echo link_to(image_tag('backend/logo'), 'home/index') ?></h1>
			<h2 class="section_title">Acesso administrativo</h2><div class="btn_view_site"><a href="http://www.irank.com.br">iRank Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="main" class="column">
		
	<?php echo $sf_data->getRaw('sf_content') ?>
		
	</section>
</body>

</html>