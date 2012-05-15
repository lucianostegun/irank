<div class="sfTContainer">
  <?php echo link_to(image_tag('maintenanceLogo', array('alt'=>'Site em manutenção', 'class'=>'sfTLogo')), 'http://www.irank.com.br', array('title'=>'iRank - Poker Ranking')) ?>
  <div class="sfTMessageContainer sfTAlert">
    <?php echo image_tag('maintenance', array('title'=>'Site em manutenção', 'class'=>'sfTMessageIcon')) ?>
    <div class="sfTMessageWrap">
      <h1>Estamos em manutenção</h1>
    </div>
  </div>

  <dl class="sfTMessageInfo">
    <dd>Prezado usuário,<br/><br/>
    O <b>iRank</b> está temporariamente indisponível pois está passando por um processo de manutenção e atualização.<br/>
    Caso necessário, entre em contato conosco através do e-mail <a href="mailto:contato@irank.com.br">contato<span>@</span>irank.com.br</a>
    e teremos prazer em responder.<br/><br/>
    O prazo para conclusão é de aproximadamente 1 hora.<br/>
    Pedimos que retorne dentro deste prazo e confira todas as novidades que preparamos para você.</dd>

	<br/>
  <dt>
  	iRank Team<br/>
  	<span class="maintenanceDate"><?php echo Config::getConfigByName('maintenanceScheduleDate', true) ?></span>
  </dt>
  </dl>
  <div class="clear"></div>
</div>