<div class="errorWrapper">
    <span class="sadEmo"></span>
    <span class="errorTitle">Huum... Tem algo errado por aqui :(</span>
    <span class="errorNum denied">ACESSO NEGADO</span>
    <span class="errorDesc">
    	Você não tem permissão para acessar a página solicitada!<br/>
    	Por favor, entre em contato com o responsável pela administração.
    </span>
    <?php echo link_to('<span>Voltar para a página anterior</span>', '#javascript.back(-1)', array('class'=>'button dredB')) ?>
	<?php echo link_to('<span>Efetuar o login</span>', 'login/index', array('class'=>'button blueB')) ?>
</div>