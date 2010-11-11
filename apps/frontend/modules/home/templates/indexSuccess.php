<div class="mainTop">
	<table cellspacing="0" width="100%" cellpadding="0" border="0">
		<tr>
			<td><div class="homeLink"><?php echo link_to('Home', '/home') ?></div></td>
		</tr>
		<tr>
			<td>
				<div class="topMenu">
					<div class="item" style="background: none"><?php echo link_to('Cadastro', '/sign') ?></div>
					<div class="item"><?php echo link_to('Contato', '/home') ?></div>
				</div>
			</td>
		</tr>
	</table>

</div>
<div class="mainContent">
	<div class="home">
		<div class="leftPanel">aaa</div>
		<div class="rightPanel">aaa</div>
	</div>
	<div class="footer">
		<table cellspacing="0" cellpadding="0" border="0" style="margin: 10px">
			<tr>
				<td><?php echo image_tag('frontend/layout/privacyPolicy') ?></td>
			</tr>
		</table>
	</div>
	<?php echo image_tag('frontend/layout/footerBase.png') ?>
</div>