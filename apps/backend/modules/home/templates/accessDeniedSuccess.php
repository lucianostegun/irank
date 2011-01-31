<div style="margin: 25 0 0 50">
Você não tem permissão de acesso no módulo escolhido.<br />
Verifique com o administrador do sistema sua lista de módulos permitidos.<br /><br />
Este pode ser um erro temporário devido as alterações em suas permissões de acesso.<br />
Faça o logout no sistema e efetue sua autenticação novamente.<br /><br />
<?php echo image_tag( 'backend/linkOut16', array( 'align'=>'absmiddle' ) ) ?>&nbsp;&nbsp;<a href="javascript:history.go(-1)" class="noline">voltar para a página anterior</a><br />
<?php echo image_tag( 'backend/linkOut16', array( 'align'=>'absmiddle' ) ) ?>&nbsp;&nbsp;<?php echo link_to( 'ir para a página de entrada', '/home', array('class'=>'noline') ) ?><br />
<?php echo image_tag( 'backend/linkOut16', array( 'align'=>'absmiddle' ) ) ?>&nbsp;&nbsp;<?php echo link_to( 'sair e efetuar o login novamente', '/login/logout', array('class'=>'noline') ) ?>
</div>