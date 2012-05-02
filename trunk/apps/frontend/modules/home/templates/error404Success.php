<style>
	h1.error404 {

		color: #ffffff; font-size: 150px; text-stroke: 1px transparent; padding: 0px 0 0px 0; display: block;
		text-align: center;
		text-shadow: 0 1px 0 #ccc,
		               0 2px 0 #c9c9c9,
		               0 3px 0 #bbb,
		               0 4px 0 #b9b9b9,
		               0 5px 0 #aaa,
		               0 6px 1px rgba(0,0,0,.1),
		               0 0 5px rgba(0,0,0,.1),
		               0 1px 3px rgba(0,0,0,.3),
		               0 3px 5px rgba(0,0,0,.2),
		               0 5px 10px rgba(0,0,0,.25),
		               0 10px 10px rgba(0,0,0,.2),
		               0 20px 20px rgba(0,0,0,.15);
	}
</style>
<h1 class="error404">404</h1>
<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 550px; margin-top: 20px">
		<tr>
			<th colspan="2"><h1>Ops... Página não encontrada!</h1></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center" class="icon">
				<?php echo image_tag('error404', array('align'=>'left')) ?>
			</td>
			<td align="left" valign="top" class="message">
				A página que você está tentando acessar não existe ou foi alterada para outro endereço!<br/><br/>
				Se você chegou aqui através de um link do site, por favor clique no link abaixo e nos conte como chegou até aqui.<br/>
				Caso você tenha digitado o endereço diretamente, verifique se digitou corretamente. 
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="link">
				<div class="separator"></div>
				<?php echo link_to(__('ClickHere'), '/contact', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para nos contas como chegou até essa página.<br/>
				<?php echo link_to(__('ClickHere'), '#history.back()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para voltar à página anterior.<br/>
				<?php echo link_to(__('ClickHere'), '/home', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('homeLink') ?>.<br/>
			</td>
		</tr>
	</table>
</div>