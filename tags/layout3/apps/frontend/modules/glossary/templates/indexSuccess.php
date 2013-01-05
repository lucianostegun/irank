<?php include_partial('home/component/commonBar', array('pathList'=>array('Glossário de termos'=>null))); ?>
<div class="moduleIntro">
	Todos os termos encontrados aqui foram reescritos de forma que seja compreensível<br/>
	tanto por jogadores iniciantes até aqueles que nunca jogaram Poker antes.<br/><br/>
	Caso ainda tenha dúvidas ou não tenha encontrado algum termo que procura,<br/>
	envie uma mensagem pelo <?php echo link_to('formulário de contato', 'contact/index') ?>.
</div>
<?php include_partial('glossary/include/index', array('letter'=>null)) ?>