<?php include_partial('home/component/commonBar', array('pathList'=>array('Glossário de termos'=>null))); ?>
<?php echo image_tag('glossary', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Todos os termos encontrados aqui foram reescritos de forma que seja compreensível tanto por jogadores iniciantes até aqueles que nunca jogaram Poker antes.<br/><br/>
	<?php echo link_to('Entre em contato', 'contact/index') ?> caso ainda tenha dúvidas ou não tenha encontrado algum termo que procura.
</div>
<hr class="separator"/>
<?php include_partial('glossary/include/index', array('letter'=>null)) ?>